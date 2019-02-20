<?php
/**
 * Created by PhpStorm.
 * User: xpwsg
 * Date: 2018/12/29
 * Time: 10:52
 */

namespace app\api\controller\charts;


use app\admin\model\ParkRoom;
use app\api\controller\Common;

/**
 * Class Index15
 * @package app\api\controller\charts
 * 海天教具3号
 */
class Index15 extends Common
{
    public function build_floor()
    {
        $floor = \input('floor', 1);
        $model = new ParkRoom();
        switch ($floor) {
            case 1:
                $return = $model
                    ->where('phase', 18)
                    ->where('floor', $floor)
                    ->order('room_number ase')
                    ->select();
                $return['svg'] = <<<EFO
<svg width="650" height="248" viewBox="0 0 1621 620" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet">
 <g class="layer">
  <g id="svg_1" fill="#000000" transform="translate(0.000000,723.000000) scale(0.100000,-0.100000)">
   <path id="svg_2" d="m1530,3775l0,-1775l5895,0l5895,0l0,1775l0,1775l-5895,0l-5895,0l0,-1775zm11730,0l0,-1715l-5835,0l-5835,0l0,1715l0,1715l5835,0l5835,0l0,-1715z"/>
   <path id="svg_3" d="m6987,4076c-4,-9 -2,-16 4,-16c6,0 7,-6 1,-16c-5,-9 -6,-28 -4,-42l6,-27l7,25c7,24 7,24 8,3c1,-19 7,-23 36,-23c31,0 35,3 35,25c0,23 -4,25 -41,25c-34,0 -39,3 -35,18c8,23 -9,50 -17,28z"/>
   <path id="svg_4" d="m7033,4083c9,-2 25,-2 35,0c9,3 1,5 -18,5c-19,0 -27,-2 -17,-5z"/>
   <path id="svg_5" d="m7133,4082c-17,-3 -23,-10 -23,-30c0,-15 -3,-38 -5,-52c-5,-24 -5,-24 4,-2c10,22 41,31 41,11c0,-5 -4,-7 -10,-4c-5,3 -10,1 -10,-4c0,-6 5,-11 11,-11c5,0 7,-6 4,-12c-4,-7 0,-5 7,4c10,11 19,14 29,7c8,-5 19,-9 24,-9c6,0 4,4 -3,8c-9,6 -10,16 -3,34c11,30 6,38 -23,39c-15,1 -12,3 9,8l30,7l-30,5c-16,2 -40,3 -52,1zm17,-16c0,-2 -7,-6 -15,-10c-8,-3 -15,-1 -15,4c0,6 7,10 15,10c8,0 15,-2 15,-4zm35,-26c3,-5 -1,-10 -10,-10c-9,0 -13,5 -10,10c3,6 8,10 10,10c2,0 7,-4 10,-10zm-38,-6c-3,-3 -12,-4 -19,-1c-8,3 -5,6 6,6c11,1 17,-2 13,-5zm40,-20c-3,-3 -12,-4 -19,-1c-8,3 -5,6 6,6c11,1 17,-2 13,-5z"/>
   <path id="svg_6" d="m7243,4082c-19,-3 -23,-10 -23,-42c0,-32 3,-37 19,-33c11,3 21,-2 24,-11c6,-16 52,-22 60,-8c3,4 2,25 -2,46c-6,42 -30,56 -78,48zm17,-22c0,-5 -7,-10 -15,-10c-8,0 -15,5 -15,10c0,6 7,10 15,10c8,0 15,-4 15,-10zm50,0c0,-5 -9,-10 -20,-10c-11,0 -20,5 -20,10c0,6 9,10 20,10c11,0 20,-4 20,-10zm-50,-30c0,-5 -7,-10 -15,-10c-8,0 -15,5 -15,10c0,6 7,10 15,10c8,0 15,-4 15,-10zm50,0c0,-5 -9,-10 -20,-10c-11,0 -20,5 -20,10c0,6 9,10 20,10c11,0 20,-4 20,-10zm10,-30c0,-5 -11,-10 -25,-10c-14,0 -25,5 -25,10c0,6 11,10 25,10c14,0 25,-4 25,-10z"/>
   <path id="svg_7" d="m7379,4071c28,-5 32,-8 20,-18c-8,-6 -25,-13 -39,-16c-25,-4 -25,-4 3,-6c19,-1 27,-6 27,-20c0,-11 -6,-21 -12,-24c-7,-2 -10,-8 -6,-12c12,-12 28,5 28,30c0,18 6,25 28,28l27,4l-30,2l-30,1l25,20l25,20l-50,-2c-44,-1 -46,-1 -16,-7z"/>
   <path id="svg_8" d="m7020,4055c0,-10 10,-15 30,-15c20,0 30,5 30,15c0,10 -10,15 -30,15c-20,0 -30,-5 -30,-15zm43,-2c-7,-2 -19,-2 -25,0c-7,3 -2,5 12,5c14,0 19,-2 13,-5z"/>
   <path id="svg_9" d="m7030,3710c-10,-6 -11,-10 -2,-10c7,0 12,-13 12,-29c0,-16 -6,-32 -12,-34c-7,-3 -2,-6 12,-6c24,-1 25,2 22,44c-4,47 -8,51 -32,35z"/>
   <path id="svg_10" d="m7100,3710c-10,-6 -11,-10 -2,-10c7,0 12,-13 12,-29c0,-16 -6,-32 -12,-34c-7,-3 -2,-6 12,-6c24,-1 25,2 22,44c-4,47 -8,51 -32,35z"/>
   <path id="svg_11" d="m7164,3707c-12,-32 0,-72 23,-75c43,-6 42,78 -1,86c-9,2 -19,-3 -22,-11zm36,-33c0,-24 -4,-34 -12,-32c-24,8 -22,68 2,68c5,0 10,-16 10,-36z"/>
   <path id="svg_12" d="m7234,3707c-12,-32 0,-72 23,-75c43,-6 42,78 -1,86c-9,2 -19,-3 -22,-11zm36,-33c0,-24 -4,-34 -12,-32c-24,8 -22,68 2,68c5,0 10,-16 10,-36z"/>
   <path id="svg_13" d="m7353,3683c-30,-4 -33,-7 -32,-36l1,-32l8,30c6,24 8,26 9,8c2,-36 38,-30 43,7c3,17 4,29 4,28c-1,0 -16,-3 -33,-5z"/>
  </g>
  <path class="room" id="room_01" d="m166,183l1151,-1l3,330l-1154,-2l0,-327z" stroke-linecap="null" stroke-linejoin="null" stroke-dasharray="null" stroke-width="null" stroke="#000000" fill="#e5e5e5"/>
 </g>
</svg>
EFO;
                return \show(1, 'OK', $return, 200);
                break;

            default:
                return '未知楼层';
                break;
        }
    }
}
