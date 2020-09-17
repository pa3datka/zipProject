<?php

namespace application\core;


class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $param) {
            $this->add($key, $param);
        }
    }

    public function add($route, $params)
    {
        $arrRoute = explode('/', $route);
        if (count($arrRoute) > 1) {
            $rout = '#^' . $arrRoute[0] . '\/([0-9a-zA-Z]{5})$#';
        } else {
            $rout = '#^' . $route . '$#';
        }
        $this->routes[$rout] = $params;
    }

    public function math()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                if (count($matches) > 1) {
                    $arr = ['param' => $matches[1]];
                    $this->params = $params += $arr;
                    return true;
                } else {
                    $this->params = $params;
                    return true;
                }
            }
        }
        return false;
    }


    public function run()
    {
        if ($this->math()) {
            $controller = 'application\\controllers\\' . ucfirst($this->params['controller'] . 'Controller');
            if (class_exists($controller)) {
                $action = $this->params['action'];
                if (method_exists($controller, $action)) {
                    $controllers = new $controller($this->params);
                    $controllers->$action();
                } else {
                    include $_SERVER['DOCUMENT_ROOT'] . '/resources/view/404.php';
                }
            } else {
                include $_SERVER['DOCUMENT_ROOT'] . '/resources/view/404.php';
            }
        } else {
            include $_SERVER['DOCUMENT_ROOT'] . '/resources/view/404.php';
        }
    }


}