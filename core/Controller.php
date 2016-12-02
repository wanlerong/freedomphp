<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/26
 * Time: 下午8:12
 */
namespace FreedomPHP\Core;

class Controller{

    public $application;

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
}