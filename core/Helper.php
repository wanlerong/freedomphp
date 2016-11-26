<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/25
 * Time: 下午11:18
 */
namespace FreedomPHP\Core;

class Helper
{
    public static function loadHelper($filename)
    {
        if (is_file(APP_PATH.'helper/'.$filename.'.php'))
        {
            return require_once APP_PATH.'helper/'.$filename.'.php';
        }
    }
}