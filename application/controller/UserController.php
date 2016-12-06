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
use FreedomPHP\Core\Email;

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

            $add_data['username'] = $username;
            $add_data['password'] = my_md5($password);
            $add_data['email'] = $email;
            $add_data['email_code'] = md5(time().$username);
            $add_data['status'] = 0;


            if ($id=$this->UserModel->addinfo($add_data)){
                $user_session = array(
                    'id'        =>  $id,
                    'username'  =>  $username,
                    'email'     =>  $email,
                );

                //发送验证邮件
                $emailer = new Email();
                $to[] = $email;
                $title = 'Notehubs注册验证邮件';
                $url = BASE_URL.'/user/check?email_code='.$add_data['email_code'].'&id='.$id;
                $content= <<<EOF
尊敬的{$username},欢迎使用Notehubs。请点击下面的链接完成验证
{$url}
EOF;
                $emailer->send($to,$title,$content);

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

    /**
     * 验证邮件
     */
    public function check(){
        $code = Input::get('email_code');
        $id = Input::get('id');

        $data = $this->UserModel->builder->find($id);
        if ($data['email_code']==$code)
        {
            $up_data['status'] = 1;
            $up_data['id'] = $data['id'];
            $this->UserModel->builder->update($up_data);
        }
        //重定向浏览器 wlr:notice这里可以封装一个redirect方法
        header("Location: ".BASE_URL."/user/index");
        exit;
    }

    /**
     * 测试
     */
    public function test(){
    }
}