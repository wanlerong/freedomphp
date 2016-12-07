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
        $this->static_files['css'][] = 'css/user.css';
    }

    /**
     * 首页
     */
    public function index()
    {
        $data=array();
        //如果已登录
        if ($this->Session->islogin){

            $data['session'] = $this->Session->userdata();
            $this->display('index/index',$data);
        }else{//如果未登录

            $this->display('user/index',$data);
        }
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
            }

            $this->ajaxReturn(AJ_RET_SUCC,'注册成功',array('forward'=>site_url('user','login')));
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

            $data = $this->UserModel->builder->where(array('email'=>$email))->first();
            if (empty($data)){
                $this->ajaxReturn(AJ_RET_FAIL,'邮箱不存在,请先注册',array('forward'=>'stop'));
            }elseif ($data['status']==0) {
                $this->ajaxReturn(AJ_RET_FAIL,'您的账号还没有完成邮箱验证',array('forward'=>'stop'));
            }elseif ($data['password']!=my_md5($password)){
                $this->ajaxReturn(AJ_RET_FAIL,'用户名或密码错误',array('forward'=>'stop'));
            }else{
                //设置session
                $user_session = array(
                    'id'        =>  $data['id'],
                    'username'  =>  $data['username'],
                    'email'     =>  $data['email'],
                );
                $this->Session->set_userdata($user_session);
                $this->ajaxReturn(AJ_RET_SUCC,'登录成功',array('forward'=>site_url('user','index')));
            }
        }

        $data=array();
        $this->display('user/login',$data,'login_iframe');
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
            alert('验证成功,请前往登录',site_url('user','login'));
        }else{
            die('非法访问');
        }
    }

    /**
     * ajax判断用户名是否存在
     */
    public function is_unique_username(){
        $username = Input::post('username');
        $data = $this->UserModel->builder->where(array('username'=>$username))->first();
        if (empty($data)){
            $valid = true;
        }else{
            $valid = false;
        }
        echo json_encode(array(
            'valid' => $valid,
        ));
        exit;
    }

    /**
     * ajax判断邮箱是否存在
     */
    public function is_unique_email(){
        $email = Input::post('email');
        $data = $this->UserModel->builder->where(array('email'=>$email))->first();
        if (empty($data)){
            $valid = true;
        }else{
            $valid = false;
        }
        echo json_encode(array(
            'valid' => $valid,
        ));
        exit;
    }

    /**
     * 退出登录
     */
    public function logout(){
        $this->Session->unset_userdata();
        redirect(site_url('user','index'));
    }

    /**
     * 测试
     */
    public function test(){
        $data = array();
        if (IS_POST){
            $a = Input::post('a');
            echo $a;
        }
        $this->display('test',$data);

    }
}