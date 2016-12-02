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

/**
 * 静态文件目录
 */
define('ASSETS_PATH',       APP_PATH . 'assets'.DS);
define('CSS_PATH',          ASSETS_PATH . 'css' .DS);
define('JS_PATH',           ASSETS_PATH . 'js' .DS);
define('IMG_PATH',          ASSETS_PATH . 'images' .DS);

/**
 * ajax返回状态
 */
define('AJ_RET_SUCC',       200);
define('AJ_RET_FAIL',       201);
define('AJ_RET_FORB',       300);
define('AJ_RET_NOLOGIN',    900);


define('PAGE_LIST',          10);

/**
 * 启用Eloquent
 */
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;

$capsule = new DB;

// 创建链接
$capsule->addConnection((array) \FreedomPHP\Core\Library\Config::get(array('database'=>array('*')))['users']);

// 设置全局静态可访问
$capsule->setAsGlobal();

// 启动Eloquent
$capsule->bootEloquent();
