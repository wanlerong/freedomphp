<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/26
 * Time: 上午12:05
 */

namespace FreedomPHP\Core\Library;
use Webmozart\Assert\Assert;

class Input
{
    /**
     * Fetch an item from the GET array
     *
     * @param	mixed	$index		Index for item to be fetched from $_GET
     * @param	bool	$xss_clean	Whether to apply XSS filtering
     * @return	mixed
     */
    public static function get($index = NULL)
    {
        return self::_fetch_from_array($_GET, $index);
    }

    /**
     * Fetch an item from the POST array
     *
     * @param	mixed	$index		Index for item to be fetched from $_POST
     * @param	bool	$xss_clean	Whether to apply XSS filtering
     * @return	mixed
     */
    public static function post($index = NULL)
    {
        return self::_fetch_from_array($_POST, $index);
    }

    /**
     * Fetch from array
     *
     * Internal method used to retrieve values from global arrays.
     *
     * @param	array	&$array		$_GET, $_POST, $_COOKIE, $_SERVER, etc.
     * @param	mixed	$index		Index for item to be fetched from $array
     * @param	bool	$xss_clean	Whether to apply XSS filtering
     * @return	mixed
     */
    public static function _fetch_from_array(&$array, $index = NULL)
    {
        // If $index is NULL, it means that the whole $array is requested
        isset($index) OR $index = array_keys($array);

        // allow fetching multiple keys at once
        if (is_array($index))
        {
            $output = array();
            foreach ($index as $key)
            {
                $output[$key] = self::_fetch_from_array($array, $key);
            }

            return $output;
        }

        if (isset($array[$index]))
        {
            $value = $array[$index];
        }
        elseif (($count = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $index, $matches)) > 1) // Does the index contain array notation
        {
            $value = $array;
            for ($i = 0; $i < $count; $i++)
            {
                $key = trim($matches[0][$i], '[]');
                if ($key === '') // Empty notation will return the value as array
                {
                    break;
                }

                if (isset($value[$key]))
                {
                    $value = $value[$key];
                }
                else
                {
                    return NULL;
                }
            }
        }
        else
        {
            return NULL;
        }
        return $value;
    }
}