<?php


namespace Application\Controllers;

use Application\Models\LockFileModel;
use Application\Core\Controller;
use Application\models\ZipFileModel;
use application\lib\Date;
class HomeController extends Controller
{
    public function index()
    {
        $this->view->render('startHome', 'главная страница');
        // return $this->view->render('layouts/header','главная страница');
    }
}