<?php


namespace Application\Controllers;


use Application\Core\Controller;
use Application\models\ZipModel;

class HomeController extends Controller
{
    public function index()
    {
        $model = new ZipModel();
        $result = $model->select();

        $this->view->render('главная страница');
    }

    public function addZip()
    {
        $model = new ZipModel();
        if ($_FILES['file']) {
            foreach ($_FILES['file'] as $key => $value) {
                $arrZip[$key] = $value;
            }
            $name = $arrZip['name'];
            $tmp = $arrZip['tmp_name'];


        }
    }
}