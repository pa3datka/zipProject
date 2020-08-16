<?php


namespace Application\Controllers;

use Application\Core\Controller;
use application\lib\Date;
use Application\Lib\ZipManager;
use Application\Models\ZipFileModel;
use Application\Models\LockFileModel;

class ZipController extends Controller
{
    private $arrType = ['application/x-zip-compressed'];

    public function addZip()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if((new Date((new LockFileModel())->getLastEntry($ip)))->dateDiffSecond() > 10) {
            if ($_FILES['file']) {
                $arrFile = $_FILES['file'];
                if ($this->checkingCompliance($arrFile)) {
                    $arrFile['name'] = ($newFileName = $this->genirationURL());
                    $arrFile['ip'] = $_SERVER['REMOTE_ADDR'];
                    $zip = new ZipManager();
                    if ($zip->checkZip($arrFile)) {
                        if ((new ZipFileModel())->saveZip($arrFile)) {
                            $url = $_SERVER['HTTP_ORIGIN'] . '/zip/' . $newFileName;
                            (new LockFileModel())->saveLock($arrFile);
                            return $this->view->render('showURL', 'URL', ['url' => $url]);
                        } else
                            echo 'Не удалось сохранить файл. Попробуйте позже!';
                    } else
                        echo 'Архив не содержит файл "index.html"!!!';
                } else
                    echo 'Не удалось сохранить файл на сервер!';

            } else
                header('Location: /');
        }
    }

    public function showZip()
    {
        $fileName = $this->route['param'];
        $publicDir = $_SERVER['DOCUMENT_ROOT'] . '/public/' . $fileName;
        if (is_dir($publicDir)) {
            header('Location: /public/'.$fileName.'/index.html');
        } else {
            $pathDir = $_SERVER['DOCUMENT_ROOT'] . '/zip/' . $fileName;
            $pathFile = $pathDir.'.zip';
            $zipFile = new ZipFileModel();
            if ($file = $zipFile->umploadZip($fileName)) {
                if (file_put_contents($pathFile, $file)) {
                    if ((new ZipManager())->retrievedZip($pathDir, $fileName)) {
                        header('Location:/public/'.$fileName.'/index.html');
                    }
                }
            } else {
                echo "<h3>Файла с таким иминем не существуе!</h3>";

            }
        }
    }

    private function checkingCompliance(array $arrFile)
    {
        if ($arrFile['error'] == 0 && $arrFile['size'] < 11000) {
            foreach ($this->arrType as $type) {
                if ($type == $arrFile['type']) {
                    return true;
                    break;
                } else
                    return false;
            }
        } else
            return false;
    }

    private function genirationURL()
    {
        $time = date('is', time());
        $arrASC = array_merge(range(65, 90), range(97, 122));
        return chr($arrASC[array_rand($arrASC)]) . $time;
    }

}