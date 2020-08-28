<?php


namespace application\controllers;


use application\core\Controller;

class FileController extends Controller
{
    public function showProject()
    {
        $fileName = $this->route['param'];
        $arrStr = str_split($fileName);
        $publicDir = $_SERVER['DOCUMENT_ROOT'] . '/public/'. $arrStr[0]. '/' . $fileName;
        if (is_dir($publicDir)) {
            header('Location: /public/'.$arrStr['0']. '/' . $fileName . '/index.html');
        } else {
            echo __e()->file_not_found;
        }
    }
}