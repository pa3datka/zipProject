<?php


namespace Application\Controllers;

use Application\Core\Controller;
use application\lib\Date;
use Application\Lib\ZipManager;
use Application\Models\ZipFileModel;
use Application\Models\LockFileModel;
use Exception;

class ZipController extends Controller
{

    private $arrType = ['application/x-zip-compressed'];

    public function addZip()
    {
        if ($this->checkRequestTime()){
            $arrFile = $_FILES['file'];
            $arrFile['name'] = $this->genirationName();
            $zip = new ZipManager($arrFile);
            if ($zip->checkFileZip()) {
               if ((new ZipFileModel())->saveZip($arrFile)) {
                   $url = 'zipproject/zip/'.$arrFile['name'];
                   return $this->view->render('showUrl', 'Url', ['url' => $url]);
               } else {
                   echo 'Не удалось сохранить';
               }
            } else {
                echo 'Ошибка при загрузке на сервер';
            }
        } else {
            echo 'время запроса';
        }

    }

    public function showZip()
    {
        $fileName = $this->route['param'];
        $publicDir = $_SERVER['DOCUMENT_ROOT'] . '/public/' . $fileName;
        if (is_dir($publicDir)) {
            header('Location: /public/' . $fileName . '/index.html');
        } else {
            $pathDir = $_SERVER['DOCUMENT_ROOT'] . '/zip/' . $fileName;
            $pathFile = $pathDir . '.zip';
            $zipFile = new ZipFileModel();
            if ($file = $zipFile->umploadZip($fileName)) {
                if (file_put_contents($pathFile, $file)) {
                    if ((new ZipManager())->extractionZip($pathDir, $fileName)) {
                        header('Location:/public/' . $fileName . '/index.html');
                    }
                }
            } else {
                echo '<h3>Файла с таким иминем не существуе!</h3>';

            }
        }
    }


    private function genirationName()
    {
        $time = date('is', time());
        $arrASC = array_merge(range(65, 90), range(97, 122));
        return chr($arrASC[array_rand($arrASC)]) . $time;
    }

    private function checkRequestTime()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if ((new Date((new LockFileModel())->getLastEntry($ip)))->dateDiffSecond() > 10) {
            return true;
        } else return false;
    }
//zipproject/zip/Y1151
}