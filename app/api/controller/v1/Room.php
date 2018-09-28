<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/9/26
 * Time: 9:57
 */

namespace app\api\controller\v1;


use app\api\controller\Common;
use app\api\model\ParkRoom;
use think\Db;

/**
 * Class Room
 * @package app\api\controller\v1
 * 房源管理
 */
class Room extends Common
{
    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 房源列表
     */
    public function room_list()
    {
        //按照租赁状态
        $opentype_check = input('status', '');
        //按照楼层
        $floor = \input('floor', '');
        //按照期数
        $phase = \input('phase', '');

        //按照面积
        $size1 = \input('size1', '');
        $size2 = \input('size2', '');
        $where = array();
        if ($opentype_check !== '') {
            $where['status'] = $opentype_check;
        }
        if ($floor !== '') {
            $where['floor'] = $floor;
        }
        if ($phase !== '') {
            $where['phase'] = $phase;
        }
        if ($size1 != '' && $size2 != '') {
            $where['area'] = ['between', [$size1, $size2]];
        }
        $model = new ParkRoom();
        $list = $model->where($where)->select();
        return \show(1, 'Ok', $list, 200);
    }

    /**
     * @return \think\response\Json
     * @throws \think\exception\DbException
     * 房源详情
     */
    public function room_detail()
    {
        $room_id = \input('room_id');
        $detail = ParkRoom::get($room_id)->append(['room_pic_allurl', 'status']);;
        return \show(1, 'Ok', $detail, 200);
    }

    /**
     * @return \think\response\Json
     * 看房预约
     */
    public function room_visit()
    {
        $room_id = \input('room_id');
        $time = \input('time');
        $name = \input('name');
        $phone = \input('phone');
        if ($room_id && $time && $name && $phone) {
            $rule = '/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|16[6]|(17[0,3,5-8])|(18[0-9])|19[89])\d{8}$/';
            $rst = \preg_match($rule, $phone);
            if (!$rst) {
                return \show(0, '手机号不正确', '',201);
            }
            $data = [
                'room_id' => $room_id,
                'visit_time' => \strtotime($time),
                'name' => $name,
                'phone' => $phone,
                'create_time' => \time(),
            ];
            $res = Db::name('RoomVisit')->insert($data);
            if ($res) {
                return \show(1, '预约成功', '', 200);
            } else {
                return \show(0, '预约失败', '', 201);
            }
        } else {
            return \show(0, '数据不完整', '', 201);
        }
    }
}