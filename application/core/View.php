<?php


namespace application\core;

/**
 * Class View
 * @package application\core
 */
class View
{
    public $path;
    public $route;

    /**
     * View constructor.
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    /**
     * @param $view
     * @param $title
     * @param array $wars
     */
    public function render($view,$title, $wars = [])
    {
         include_once $_SERVER['DOCUMENT_ROOT'].'/resources/view/'.$view.'.php';
    }
}