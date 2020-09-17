<?php


namespace application\core;

use application\core\View;

/**
 * Class Controller
 * @package application\core
 */
 abstract class Controller
{
    public $route;
    public $view;
    public $params;

     /**
      * Controller constructor.
      * @param $route
      */
    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }
 }