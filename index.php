<?php
/**
 * Welcome To FreedomPHP!
 * 入口文件
 */
use \FreedomPHP\Core\Library\Input;

define('APP_PATH',dirname(__FILE__) . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR);
define('VENDOR_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' .DIRECTORY_SEPARATOR);
define('CORE_PATH',dirname(__FILE__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
/**
 * composer自动装载
 * 加载命名空间
 */
$autoloader = require_once VENDOR_PATH.'autoload.php';
$autoloader->addPsr4("FreedomPHP\\Core\\", CORE_PATH);
$autoloader->addPsr4("Application\\", APP_PATH);

/**
 * 加载常量配置
 */
require_once APP_PATH.'config'.DIRECTORY_SEPARATOR.'constant.php';

/**
 * 加载公共方法
 */
\FreedomPHP\Core\Helper::loadHelper('func');


echo 111;
echo Input::get('a');