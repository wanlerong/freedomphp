<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/27
 * Time: 下午3:06
 */

namespace App\Controller;

class IndexController extends CommonController{

    public function index()
    {
        $data['info'] = 'freedom';

        $this->UserModel->test();

        p($this->UserModel->builder->find(1));

        $this->display('index',$data);
    }

}

