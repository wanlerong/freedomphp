<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/26
 * Time: 上午12:05
 */

namespace FreedomPHP\Core\Library;
use Monolog\Handler\NullHandler;
use Webmozart\Assert\Assert;


class Input
{
    public $purifier;

    public function __construct()
    {
        require_once VENDOR_PATH.'ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
        //如果第三方类没有设置命名空间，PHP默认会加上一个顶级命名空间'\'的
        $config = \HTMLPurifier_Config::createDefault();
        $this->purifier = new \HTMLPurifier($config);
    }

    /**
     * Fetch an item from the GET array
     *
     * @param	mixed	$index		Index for item to be fetched from $_GET
     * @param	bool	$xss_clean	Whether to apply XSS filtering
     * @return	mixed
     */
    public function get($index = NULL)
    {
        return $this->_fetch_from_array($_GET, $index);
    }

    /**
     * Fetch an item from the POST array
     *
     * @param	mixed	$index		Index for item to be fetched from $_POST
     * @param	bool	$xss_clean	Whether to apply XSS filtering
     * @return	mixed
     */
    public function post($index = NULL)
    {
        return $this->_fetch_from_array($_POST, $index);
    }

    /**
     * Fetch from array
     *
     * Internal method used to retrieve values from global arrays.
     *
     * @param    array &$array $_GET, $_POST, $_COOKIE, $_SERVER, etc.
     * @param    mixed $index Index for item to be fetched from $array
     * @param $fliter 过滤函数
     * @return mixed
     * @internal param bool $xss_clean Whether to apply XSS filtering
     */
    public function _fetch_from_array(&$array, $index = NULL)
    {
        // If $index is NULL, it means that the whole $array is requested
        isset($index) OR $index = array_keys($array);


        // allow fetching multiple keys at once
        if (is_array($index))
        {
            $output = array();
            foreach ($index as $key)
            {
                $output[$key] = $this->_fetch_from_array($array, $key);
            }

            return $output;
        }
        if (isset($array[$index]))
        {
            $value = $this->Fliter($array[$index]);
        }
        else
        {
            return NULL;
        }
        return $value;
    }

    /**
     * 过滤方法
     * 如果是数组,就放到array_walk中过滤,然后返回
     * 不是数组,直接过滤返回
     * @param $dirty_html
     * @param $off_html 是否将html代码转化成实体
     * @return mixed
     */
    public function Fliter($dirty_html,$off_html=true){
        if (is_array($dirty_html)){
            //用回调函数过滤数组中的单元
            if (array_walk($dirty_html, array($this, 'callbackfliter'))){
                //如果过滤完毕
               return $dirty_html;
            }
        }elseif($off_html){
            $clean_html = $this->purifier->purify($dirty_html);
            $clean_html = htmlspecialchars($clean_html);
        }else{
            $clean_html = $this->purifier->purify($dirty_html);
        }
        return $clean_html;
    }

    public function callbackfliter(&$value){
        $value = $this->Fliter($value);
    }
}



