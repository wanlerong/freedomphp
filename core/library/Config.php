<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/27
 * Time: 下午3:13
 */

namespace FreedomPHP\Core\Library;

class Config{
    public static $file;

    public static function loadFile($filename)
    {
        if (empty(self::$file[$filename]))
        {
            self::$file[$filename] = include_once APP_PATH."/config/".$filename.".php";
        }
        return self::$file[$filename];
    }
    /**
     * @param $key
     * @return null
     * @throws \Exception
     */
    public static function get(array $filekey)
    {
        if (!$filekey || !is_array($filekey) || count($filekey)>1) {
            die('配置文件加载错误');
        }

        $filename = array_keys($filekey)[0];

        $config = self::loadFile($filename);


        reset($filekey);

        foreach (current($filekey) as $v) {
            if ($v == '*'){
                return $config;
            }else{
                if (isset($config[$v])){
                    $result[$v] = $config[$v];
                }
            }
        }
        return $result;
    }
}