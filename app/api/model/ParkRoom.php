<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/9/26
 * Time: 10:01
 */

namespace app\api\model;


use think\Model;
use think\Request;

/**
 * Class ParkRoom
 * @package app\api\model
 */
class ParkRoom extends Model
{
    /**
     * @var array
     */
    protected $visible = [
        'id',
        'room_number',
        'area',
        'phase',
        'room_img',
        'status'
    ];

    /**
     * @param $room_img
     * @return string
     * 返回拼接好的图片路径
     */
    public function getRoomImgAttr($room_img)
    {
        if (!empty($room_img)) {
            $request = Request::instance();
            return $request->domain() . $room_img;
        } else {
            return '';
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getPhaseAttr($value)
    {
        $status = [1 => '海创空间大厦一期', 2 => '海创空间大厦二期'];
        return $status[$value];
    }

    /**
     * @param $value
     * @return mixed
     * 返回房源的入驻状态
     */
    public function getStatusAttr($value)
    {
        $status = [0 => '暂无企业入驻', 1 => '已有企业入驻'];
        return $status[$value];
    }

    /**
     * @param $room_pic_allurl
     * @return array
     * 返回拼接好的多图路径
     */
    public function getRoomPicAllurlAttr($room_pic_allurl)
    {
        $request = Request::instance();
        $arr = \explode(',', $room_pic_allurl);

        foreach ($arr as &$v) {
            if (!empty($v)) {
                $v = $request->domain() . $v;
            }
        }
        return array_filter($arr);
    }
}