<?php
/**
 * Welcome To FreedomPHP!
 * 入口文件
 */
use \FreedomPHP\Core\Library\Input;
use \FreedomPHP\Core\Library\Config;

define('APP_PATH',dirname(__FILE__) . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR);
define('VENDOR_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' .DIRECTORY_SEPARATOR);
define('CORE_PATH',dirname(__FILE__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
/**
 * composer自动装载
 * 加载命名空间
 */
$autoloader = require_once VENDOR_PATH.'autoload.php';
$autoloader->addPsr4("FreedomPHP\\Core\\", CORE_PATH);
$autoloader->addPsr4("App\\", APP_PATH);

/**
 * 初始化配置
 */
require_once APP_PATH.'config'.DIRECTORY_SEPARATOR.'init.php';

/**
 * 加载公共方法
 */
\FreedomPHP\Core\Helper::loadHelper('func');

/**
 * 创建应用,名称为demo
 */
$app = new \FreedomPHP\Core\Application('App');
/**
 * 创建路由
 */
$app->setRouter(
    Config::get(array('route'=>array('*')))
);


$app->run();
