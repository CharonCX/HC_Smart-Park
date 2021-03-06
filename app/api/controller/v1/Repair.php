<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/9/11
 * Time: 10:06
 */

namespace app\api\controller\v1;


use app\api\controller\AuthBase;
use app\api\library\exception\ApiException;
use app\api\model\ServiceRepair;
use think\Db;

/**
 * Class Repair
 * @package app\api\controller\v1
 * 报修模块
 */
class Repair extends AuthBase
{
    /**
     *我的报修列表
     */
    public function my_repair()
    {
        $user_id = \input('user_id');
//        判断是否绑定企业,如果没有绑定企业则返回空数据,因为APP端是这么写的
        $enterprise_id = Db::name('MemberList')->where('member_list_id', $user_id)->value('member_list_enterprise');
        if (empty($enterprise_id)) {
            \show('1', 'ok', 'null', 200);
        } else {
            $page = \input('page', 1);
            $model = new ServiceRepair();
            //已处理的列表
            $list['list0'] = $model->getRepairList($user_id, $page, ('status=2'));
            //其他情况的列表
            $list['list1'] = $model->getRepairList($user_id, $page, ('status!=2'));
            return \show(1, 'OK', $list, 200);
        }
    }


    /**
     * @return \think\response\Json
     * @throws \Exception
     * 发布报修
     */
    public function save()
    {
        $base64img = \input('image');
        if (!empty($base64img)) {
            $base64img = \json_decode($base64img);
            $pic_url = $this->img_upload($base64img);
            $pic_url = \serialize($pic_url);
        } else {
            $pic_url = '';
        }

        $sqldata = [
            'user_id' => \input('user_id'),
            'title' => \input('title'),
            'content' => \input('content'),
            'pic_url' => $pic_url,
        ];
        if (empty($sqldata['user_id']) || empty($sqldata['title']) || empty($sqldata['content'])) {
            return \show(0, '数据不完整', '', 201);
        }
        $model = new ServiceRepair();
        $res = $model->allowField(true)->save($sqldata);
        if ($res) {
            return \show('1', '报修成功', $res, 200);
        }
    }

    /**
     * @return ApiException|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 报修详情
     */
    public function read()
    {
        $id = \input('id');//报修单id
        $user_id = \input('user_id');
        $uid = Db::name('ServiceRepair')->where('id', 'eq', $id)->value('user_id');
        if ($uid != $user_id) {
            return new ApiException('身份不对', 201);
        } else {
            $enterprise_id = Db::name('MemberList')->where('member_list_id', 'eq', $user_id)->value('member_list_enterprise');
            $info['enterprise_info'] = Db::name('EnterpriseList')
                ->alias('el')
                ->join('EnterpriseEntryInfo eei', 'el.id=eei.enterprise_id')
                ->field('el.enterprise_list_name,eei.room')
                ->where('el.id', 'eq', $enterprise_id)
                ->find();
            $info['author'] = Db::name('MemberList')->where('member_list_id', 'eq', $user_id)->field('member_list_username,member_list_tel')->find();
            $info['repair_info'] = \model('ServiceRepair')->where('id', 'eq', $id)->find();
            return \show(1, 'OK', $info, 200);
        }
    }

    /**
     * @return \think\response\Json
     * @throws \think\exception\DbException
     * 用于管理后台查看的
     */
    public function admin_read()
    {
        $id = \input('id');
        $info = ServiceRepair::get($id);
        return \show(1, 'OK', $info, 200);
    }

    /**
     * @return ApiException|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 修改报修状态,撤回或者加急
     */
    public function change_status()
    {
        $id = \input('id');
        $user_id = \input('user_id');
        $status = \input('status');
        $uid = Db::name('ServiceRepair')->where('id', 'eq', $id)->value('user_id');
        if ($uid != $user_id) {
            return new ApiException('身份不对', 201, 0);
        } else {
            $res = Db::name('ServiceRepair')->where('id', 'eq', $id)->setField('status', $status);
            if (!$res) {
                return new ApiException('修改失败', 201);
            } else {
                $info = \model('ServiceRepair')->where('id', 'eq', $id)->find();
                return \show(1, 'OK', $info, 200);
            }
        }
    }
}
