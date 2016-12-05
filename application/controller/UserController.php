<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/26
 * Time: 下午6:40
 */
namespace App\Controller;

use App\Model\UserModel;
use FreedomPHP\Core\Library\Input;
use FreedomPHP\Core\Controller;

class UserController extends CommonController{


    public function __construct()
    {
        parent::__construct();
        $this->static_files['js'][] = 'js/user.js';
    }

    public function index()
    {
        $data=array();
        $this->display('user/index',$data);
    }

    /**
     * 用户注册
     */
    public function register(){
        if (IS_POST){
            $username = Input::post('username');
            $password = Input::post('password');
            $phone = Input::post('phone');

            $up_data['username'] = $username;
            $up_data['password'] = $password;
            $up_data['phone'] = $phone;

            $id = $this->UserModel->addinfo($up_data);
            $this->ajaxReturn(AJ_RET_SUCC,'注册成功',array('forward'=>site_url('user','reg')));

            $user_session = array(
                'id'        =>  $id,
                'username'  =>  $username,
            );

            $_SESSION['user'] = $user_session;
        }

        $data = array();
        $this->display('user/register',$data);
    }
}