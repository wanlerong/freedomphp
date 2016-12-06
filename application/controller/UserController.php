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

class UserController extends CommonController{


    public function __construct()
    {
        parent::__construct();
        $this->static_files['js'][] = 'js/user.js';
    }

    /**
     * 首页
     */
    public function index()
    {
        $data=array();
        $data['session'] = $this->Session->userdata();
        $this->display('user/index',$data);
    }

    /**
     * 用户注册
     */
    public function register(){
        if (IS_POST){
            $username = Input::post('username');
            $password = Input::post('password');
            $email = Input::post('email');

            $up_data['username'] = $username;
            $up_data['password'] = my_md5($password);
            $up_data['email'] = $email;

            if ($id=$this->UserModel->addinfo($up_data)){
                $user_session = array(
                    'id'        =>  $id,
                    'username'  =>  $username,
                    'email'     =>  $email,
                );

                $this->Session->set_userdata($user_session);
            }
            $this->ajaxReturn(AJ_RET_SUCC,'注册成功',array('forward'=>site_url('user','index')));



        }

        $data = array();
        $this->display('user/register',$data);
    }

    /**
     * 用户登录
     */
    public function login(){
        if (IS_POST){
            $email = Input::post('email');
            $password = Input::post('password');


        }
    }
}