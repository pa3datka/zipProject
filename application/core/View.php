<?php


namespace Application\Core;

class View
{
    public $path;
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($view,$title, $wars = [])
    {
        return include_once $_SERVER['DOCUMENT_ROOT'].'/resources/view/'.$view.'.php';
    }
}