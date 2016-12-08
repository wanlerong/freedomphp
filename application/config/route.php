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
    ['ANY',    '/reg',              ['UserController','register']],
    ['ANY',    '/check',            ['UserController','check']],
    ['ANY',    '/login',            ['UserController','login']],
    ['POST',   '/ckusername',       ['UserController','is_unique_username']], //ajax判断用户名是否存在
    ['POST',   '/ckemail',          ['UserController','is_unique_email']], //ajax判断邮箱是否存在
    /**
     * 开发测试
     */
    ['ANY',    '/test',             ['UserController','test']],
    /**
     * Notehub模块
     */
    ['ANY',    '/addnote',          ['NotehubController','add']],



);
