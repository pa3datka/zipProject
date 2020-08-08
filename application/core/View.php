<?php


namespace Application\Core;


class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $wars = [])
    {
         require $_SERVER['DOCUMENT_ROOT'].'/resours/view/layouts/'.$this->layout.'.php';
    }
}