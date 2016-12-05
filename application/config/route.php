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
    ['ANY',    '/user/reg',     ['UserController','register']],
    ['ANY',    '/user/index',     ['UserController','index']],
);
