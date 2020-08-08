<?php

namespace Application\Core;


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
        $rout = '#^' . $route . '$#';
        $this->routes[$rout] = $params;
    }

    public function math()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
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
                }
            }
        } else {
            echo '404';
        }
    }


}