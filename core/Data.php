<?php
/**
 * this is part of xyfree
 *
 * @file Data.php
 * @use
 * @author Dongjiwu(dongjw321@163.com)
 * @date 2015-12-18 14:40
 *
 */

namespace FreedomPHP\Core;

use DongPHP\System\Libraries\DataConfigLoader;
use DongPHP\System\Libraries\Memcache;
use DongPHP\System\Libraries\Redis;

class Data
{
    /**
     * @param $key
     * @param null $hash
     * @return \Redis
     */
    public static function redis($key, $hash=null)
    {
        $config = DataConfigLoader::redis($key, $hash);
        return Redis::getInstance($config['host'], $config['port'], $config['timeout'], $config['auth']);
    }

    /**
     * @param $key
     * @param null $hash
     * @return \Memcache
     */
    public static function memcache($key, $hash=null)
    {
        $config = DataConfigLoader::memcache($key, $hash);
        return Memcache::getInstance($config['host'], $config['port']);
    }
}
