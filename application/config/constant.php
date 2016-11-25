<?php
/**
 * 常量配置
 */
define('DS',                DIRECTORY_SEPARATOR);
define('IS_CLI',            (PHP_SAPI == 'cli') ? true : false);

define('REQUEST_METHOD',    $_SERVER['REQUEST_METHOD']);
define('IS_GET',            REQUEST_METHOD =='GET' ? true : false);
define('IS_POST',           REQUEST_METHOD =='POST' ? true : false);

//模板目录
define('VIEW_PATH',         APP_PATH . 'view'.DS);
define('DOMAIN_URL',        'http://www.freedomphp.com');



define('ASSETS_PATH',       APP_PATH . 'assets'.DS);
define('CSS_PATH',          ASSETS_PATH . 'css' .DS);
define('JS_PATH',           ASSETS_PATH . 'js' .DS);
define('IMG_PATH',          ASSETS_PATH . 'images' .DS);

