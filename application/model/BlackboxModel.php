<?php
// | Author: wanlr
// +----------------------------------------------------------------------
// | DateTime: 2016-12-08 17:44
// +----------------------------------------------------------------------


namespace App\Model;

use FreedomPHP\Core\Library\DB;

class BlackboxModel extends CommonModel
{
    public function __construct()
    {
        parent::__construct();
        $this->builder = DB::builder('app.blackbox');
    }

    /**
     * 生成面包屑导航
     * @param $box_id
     */
    public function get_up_levels($box_id){
        static $here;
        $info = $this->getInfo(array('id'=>$box_id));
        if ($info['parent_id']!=0){
            $this->get_up_levels($info['parent_id']);
        }
        $here[] = $info;
        return $here;
    }

}