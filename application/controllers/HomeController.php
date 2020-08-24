<?php


namespace application\controllers;

use application\core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->view->render('startHome', 'главная страница');
        // return $this->view->render('layouts/header','главная страница');
    }
}