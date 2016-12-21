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
    ['ANY',    '/reg',              ['UserController','register']],             //注册模块
    ['ANY',    '/check',            ['UserController','check']],                //验证邮件模块
    ['ANY',    '/login',            ['UserController','login']],                //登录模块
    ['POST',   '/ckusername',       ['UserController','is_unique_username']],   //ajax判断用户名是否存在
    ['POST',   '/ckemail',          ['UserController','is_unique_email']],      //ajax判断邮箱是否存在
    /**
     * 开发测试
     */
    ['ANY',    '/test',             ['UserController','test']],
    /**
     * Notehub模块
     */
    ['ANY',    '/addnote',          ['NotehubController','add']],               //添加notehub
    ['ANY',    '/adminnote',        ['NotehubController','admin']],             //管理notehub
    /**
     * Blackbox模块
     */
    ['POST',    '/addbox',           ['BlackboxController','add']],              //添加blackbox
    ['POST',    '/delbox',           ['BlackboxController','delete']],           //删除blackbox
    ['POST',    '/rebox',            ['BlackboxController','recycle']],          //回收站
    ['ANY',     '/editbox',          ['BlackboxController','edit']],             //编辑blackbox


);
