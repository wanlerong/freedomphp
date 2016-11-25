<?php
/**
 * 入口文件
 */

define('APP_PATH',dirname(__FILE__) . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR);
define('VENDOR_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'vendor' .DIRECTORY_SEPARATOR);
define('CORE_PATH',dirname(__FILE__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);

$autoloader = require_once VENDOR_PATH.'autoload.php';
$autoloader->addPsr4("FreedomPHP\\Core\\", CORE_PATH);
$autoloader->addPsr4("Application\\", APP_PATH);

require_once APP_PATH.'config'.DIRECTORY_SEPARATOR.'constant.php';