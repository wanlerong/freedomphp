<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/26
 * Time: 下午8:12
 */
namespace FreedomPHP\Core;

use Pimple\Container;

abstract class Controller{

    public $application;
    public $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function setApplication($app){
        $this->application = $app;
    }

    /**
     * @param $tpl
     * @param $data
     * @param bool $output
     * @return mixed|string
     */
    public function view($tpl, $data, $output=true){
        $path = VIEW_PATH . $tpl .'.php';
        if ($data && is_array($data)) {
            extract($data,EXTR_SKIP);
        }else{
            die('视图数据格式错误');
        }
        if ($output){
            return require $path;
        }else{
            ob_start();
            require $path;
            $content = ob_get_clean();
            return $content;
        }
    }

    /**
     * 设置容器,存放服务如数据库连接等
     * A service is an object that does something as part of a larger system.
     * Examples of services: a database connection, a templating engine, or a mailer.
     * Almost any global object can be a service.
     * @param $property
     * @param $callable
     */
    protected function setProperty($property, $callable) {
        $this->container[$property] = $this->container->factory($callable);
        unset($this->$property);
    }

    /**
     * 访问不到的属性,去容器中取
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        //obj只初始化一次
        static $obj;
        if ( !isset($obj[$key]) ) {
            $obj[$key] = $this->container[$key];
        }
        return $obj[$key];
    }

}