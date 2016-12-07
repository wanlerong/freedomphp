<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/12/6
 * Time: 下午9:54
 */
namespace FreedomPHP\Core;

/*
 *  sohu email send class
 *  @author chenhl
 */
class Email
{
    private $_channel = 0;
    private static $_conf=array(
        0=>array('api_user'=>'wanlerong_test_QW3C1y', 'api_key'=>'5ejaqk0nd82QkJu8' , 'from' =>'wanlerong@jianxunkeji.com' ,'fromname' =>'notehubs'),
    );

    function __construct($channel=0)
    {
        $this->_channel = isset( self::$_conf[$channel] )?$channel:0;
    }

    public function send($email=array(), $title='', $msg='',$fromname = '')
    {
        $api_user = self::$_conf[$this->_channel]['api_user'];
        $api_key  = self::$_conf[$this->_channel]['api_key'];
        $from     = self::$_conf[$this->_channel]['from'];
        $fromname = !empty($fromname) ? $fromname : self::$_conf[$this->_channel]['fromname'];
        $return   = false;
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    //由于没有配置信任的服务器HTTPS验证。默认，cURL被设为不信任任何CAs，就是说，它不信任任何服务器验证。因此，这就是浏览器无法通过HTTPs访问你服务器的原因。使用curl_exec()之前跳过ssl检查项。
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_URL, 'https://sendcloud.sohu.com/webapi/mail.send.json');
        //不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('api_user'=>$api_user,
                'api_key'=>$api_key,
                'from'=>$from,
                'fromname'=>$fromname,
                'to'=>implode(';', $email),
                'subject'=>$title,
                'html'=>$msg)
        );

        $result=curl_exec($ch);

        if( $result === false ) //请求失败
        {
            return 'last error : '.curl_error($ch);
        }
        else
        {
            $return = true;
        }
        curl_close($ch);
        return $return;
    }
}