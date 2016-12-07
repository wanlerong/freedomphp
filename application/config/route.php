<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/27
 * Time: 下午3:44
 */

return array(
    /**
     * 首页
     */
    ['ANY',    '/',                 ['UserController','index']],
    ['ANY',    '/index.php',        ['UserController','index']],
    /**
     * 用户模块
     */
    ['ANY',    '/user/reg',         ['UserController','register']],
    ['ANY',    '/user/check',       ['UserController','check']],
    ['ANY',    '/user/login',       ['UserController','login']],
    ['POST',   '/user/ckusername',  ['UserController','is_unique_username']], //ajax判断用户名是否存在
    ['POST',   '/user/ckemail',     ['UserController','is_unique_email']], //ajax判断邮箱是否存在
    ['ANY',    '/user/test',        ['UserController','test']],
);
