<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/27
 * Time: 下午3:06
 */

namespace App\Controller;
use App\Model\UserModel;

class IndexController extends CommonController{

    public function index()
    {
        $data['info'] = 'freedom';

        $user = UserModel::select('username')->find(1);
        echo $user->username;

        $user = UserModel::all();


        $data['user'] = $user;

        foreach ($data['user'] as $v){
            p($v->username);
        }

        $this->display('index',$data);
    }

}

