<?php


namespace Application\Core;

use Application\Core\View;

 abstract class Controller
{
    public $route;
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View($route);
    }
 }