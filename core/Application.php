<?php
/**
 * Created by PhpStorm.
 * User: wlr
 * Date: 16/11/26
 * Time: 上午11:26
 */
namespace FreedomPHP\Core;
use FreedomPHP\Core\Library\Input;

if (!defined('APP_PATH'))
    throw new \Exception('APP_PATH NOT defined!');

class Application
{
    /**
     * 路由器
     * @var
     */
    protected $router;

    /**
     * controller的命名空间
     * @var
     */
    protected $controller_namespace = 'Application\Controller';
    /**
     * 默认控制器
     * @var
     */
    protected $default_controller = null;

    /**
     * 默认方法
     * @var
     */
    protected $default_method = null;

    /**
     * Application constructor.
     * @param string $namespace
     * @param string $route
     */
    public function __construct($namespace = '', $route = '')
    {
        if ($namespace) {
            $this->setNamespace($namespace);
        }

        $this->default_method    = 'index';

        if ($route) {
            $this->router = new Router($route, $this->controller_namespace);
        }

    }

    /**
     * 设置命名空间
     * @param $namespace
     */
    public function setNamespace($namespace)
    {
        $this->controller_namespace = ucfirst($namespace) . '\Controller';
        $this->default_controller   = $this->controller_namespace . '\IndexController';
    }

    /**
     * 设置路由
     * @param $route
     * @return bool
     */
    public function setRouter($route)
    {
        $this->router = new Router($route, $this->controller_namespace);
    }

    /**
     * 设置默认方法
     * @param $controller
     * @param $method
     */
    public function setDefaultMethod($controller, $method)
    {
        $this->default_controller = $this->controller_namespace . '\\' . $controller;
        $this->default_method     = $method;
    }

    /**
     * 加载框架
     * @throws Exception
     */
    public function run()
    {
        $route  = $this->getRouteInfo();
        $this->execute($route);
    }

    /**
     * 获取路由信息
     * @return array
     */
    private function getRouteInfo()
    {
        if (!$this->router) {
            $controller = ucfirst(Input::get('c'));
            $method     = Input::get('a');

            if (!$controller) {
                $controller = $this->default_controller;
            } else {
                $controller = $this->controller_namespace . '\\' . $controller.'Controller';
            }

            $method || $method = $this->default_method;

            return [
                [$controller, $method],
                ['vars' =>
                    []
                ]
            ];
        } else {
            $routeInfo = $this->router->dispatch($_SERVER['REQUEST_METHOD'], rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
            switch ($routeInfo[0]) {
                case Router::NOT_FOUND:
                case Router::METHOD_NOT_ALLOWED:
                    if ($this->default_controller && $this->default_method) {
                        $routeInfo[1] = [$this->default_controller, $this->default_method];
                        $routeInfo[2] = [];
                    } else {
                        die("Controller action method doesn't exist.");
                    }
                    break;
                case Router::FOUND:
                    break;
            }
            return [$routeInfo[1], ['vars' => $routeInfo[2]]];
        }
    }

    private function execute(array $route)
    {
        //把数组值赋给变量
        list($cb, $options) = $route;

        try {
            $rc = new \ReflectionClass($cb[0]);
        } catch (\Exception $e) {
            throw new \LogicException($e->getMessage(), $e->getCode());
        }

        //从options中获取控制器构造函数的数组参数
        $constructArgs = null;
        if (isset($options['constructor_args'])) {
            $constructArgs = $options['constructor_args'];
        }

        if (is_string($cb[0])) {
        //实例化控制器 $controller,此时$cb[0]已经是目标控制器对象.
            $cb[0] = $controller = $constructArgs ? $rc->newInstanceArgs($constructArgs) : $rc->newInstance();
        } else {
            $controller = $cb[0];
        }

        // check controller action method
        if ($controller && !method_exists($controller, $cb[1])) {
            die("Controller action method '{$cb[1]}' doesn't exist.");
        }

        // 从映射中获取全部方法的参数项
        $rps = $rc->getMethod($cb[1])->getParameters();

        $vars = isset($options['vars'])
            ? $options['vars']
            : array();

        // 从options中获取函数参数
        $arguments = array();
        foreach ($rps as $param) {
            $n = $param->getName();
            if (isset($vars[$n])) {
                $arguments[] = $vars[$n];
            } elseif (!$param->isOptional() && !$param->allowsNull()) {
                die('parameter is not defined.');
            }
        }
        $cb[0]->setApplication($this);
        return call_user_func_array($cb, $arguments);
    }
}