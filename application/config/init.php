<?php
/**
 * 常量配置
 */
define('DS',                DIRECTORY_SEPARATOR);

define('REQUEST_METHOD',    $_SERVER['REQUEST_METHOD']);
define('IS_GET',            REQUEST_METHOD =='GET' ? true : false);
define('IS_POST',           REQUEST_METHOD =='POST' ? true : false);

/**
 * 视图目录
 */
define('VIEW_PATH',         APP_PATH . 'view'.DS);
define('DOMAIN_URL',        'http://www.freedomphp.com');
define('BASE_URL',        'http://www.freedomphp.com');

/**
 * 静态文件目录
 */
define('CDN_PATH',       'http://ohpbsym8n.bkt.clouddn.com');
define('ASSETS_PATH',       'http://www.freedomphp.com/assets/');
define('CSS_PATH',          ASSETS_PATH . 'css' .DS);
define('JS_PATH',           ASSETS_PATH . 'js' .DS);
define('IMG_PATH',          ASSETS_PATH . 'img' .DS);

/**
 * ajax返回状态
 */
define('AJ_RET_SUCC',       200);
define('AJ_RET_FAIL',       201);
define('AJ_RET_FORB',       300);
define('AJ_RET_NOLOGIN',    900);


define('PAGE_LIST',          10);