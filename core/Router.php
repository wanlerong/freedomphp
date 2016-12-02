<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/26
 * Time: 下午3:47
 */

namespace FreedomPHP\Core;
use FastRoute\RouteCollector;

class Router{
    const NOT_FOUND = 0;
    const FOUND = 1;
    const METHOD_NOT_ALLOWED = 2;

    public $route;

    private $namespace;

    public function __construct($route, $namespace = '')
    {
        $this->route     = $route;
        $this->namespace = $namespace;
    }

    /**
     * 获取路由信息
     * @param $method
     * @param $uri
     * @return array
     */
    public function dispatch($method, $uri)
    {
        $routes      = $this->route;

        foreach($routes as &$route) {
            if ($route[0] == 'ANY') {
                $route[0] = ['GET','POST'];
            }
        }

        $dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) use ($routes) {
            //给控制器加上命名空间
            foreach ($routes as $row) {
                if (is_array($row[2])) {
                    foreach ($row[2] as $k => &$v) {
                        if ($k == 0) {
                            $v = $this->namespace . '\\' . $v;
                        }
                    }
                }
                $r->addRoute($row[0], $row[1], $row[2]);
            }
        });
        //匹配当前的路由信息
        $routeInfo = $dispatcher->dispatch($method, $uri);
        //如果没有匹配到
        if ($routeInfo[0] ==0 && trim($uri,'/') ) {
            $tmp             = explode('/', trim($uri, '/'));
            if (count($tmp) < 2) {
                $tmp[1] = 'index';
            }
            $method          = array_pop($tmp);
            $controller_name = implode('\\',array_map('ucfirst',$tmp)).'Controller';
            $routeInfo[0] = 4;
            $routeInfo[1] = [$this->namespace."\\".$controller_name, $method];
            $routeInfo[2] = [];
        }
        return $routeInfo;
    }

}