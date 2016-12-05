<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/12/3
 * Time: 上午9:56
 */

namespace App\Model;
use FreedomPHP\Core\Model;

class CommonModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 添加数据
     *
     * @param $data
     * @return int
     */
    public function addInfo($data){
        if(empty($data) || !is_array($data)){
            return false;
        }

        $this->builder->reset();

        return $this->builder->insertGetId($data);
    }

}