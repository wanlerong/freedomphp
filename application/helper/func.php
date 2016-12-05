<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/25
 * Time: 下午11:17
 */


function p($mixed = null) {
    echo '========<br><pre>';
    print_r($mixed);
    echo '</pre><br>';
    return null;
}

if (! function_exists('site_url')) {
    /**
     * 拼接链接地址
     *
     * @param $controller
     * @param $action
     * @param $params
     * @return string
     */
    function site_url($controller = null, $action = null, $params = array())
    {
        $url_str = '';

        $controller = $controller ? $controller : 'Index';
        $action     = $action ? $action : 'index';

        foreach ((array)$params as $k => $v) {
            $url_str .= ($url_str ? '&' : '?').$k.'='.$v;
        }

        return BASE_URL . '/'.$controller.'/'.$action.$url_str;
    }
}

if (! function_exists('my_md5')) {
    /**
     * md5加密
     * @param $password
     * @return string
     */
    function my_md5($password){
        return md5($password.'baef13vg&^*a4dw');
    }
}