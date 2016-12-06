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
    ['ANY',    '/',            ['UserController','index']],
    ['ANY',    '/index.php',   ['UserController','index']],
    /**
     * 用户模块
     */
    ['ANY',    '/user/reg',    ['UserController','register']],
);
