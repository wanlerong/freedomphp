<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/27
 * Time: 下午3:44
 */

return array(
    ['ANY',    '/',            ['IndexController','index']],
    ['ANY',    '/index.php',   ['IndexController','index']],
    ['ANY',    '/u/login',     ['UserController','login']],
    ['ANY',    '/user/reg',    ['UserController', 'reg']],
);
