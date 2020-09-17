<?php


namespace application\controllers;

use application\core\controller;
use application\lib\CreatorManagerArhive;
use application\lib\Date;
use application\lib\FileManager;
use application\models\LockFileModel;

class ArchiveController extends Controller
{

    public function addZip()
    {
        (new FileManager())->checkDir();
        if ($this->checkRequestTime()) {
            $arrFile = $_FILES['file'];
            $arrFile['name'] = $this->generationName();
            $archive = (new CreatorManagerArhive())->createObject($arrFile);
            if ($archive->checkFileArchive()) {
                if ($archive->extractionArchive()) {
                    $url = $_SERVER['HTTP_REFERER'] . $arrFile['name'];
                    (new LockFileModel())->saveLock(['ip' => $_SERVER['REMOTE_ADDR'], 'name' => $arrFile['name']]);
                    $this->view->render('showURL', 'URL', ['url' => $url]);
                } else {
                    echo __e()->failed_to_save;
                }
            } else {
                echo __e()->error_file_zip;
            }
        } else {
            echo __e()->error_time;
        }
    }

    private function generationName(): string
    {
        $number = rand(0, 9);
        $arrASC = array_merge(range(65, 90), range(97, 122));
        $symbol = $this->getOneSymbol(date('w'));
        do {
            $newNameFile = $symbol . $number . chr($arrASC[array_rand($arrASC)]) . $number . chr($arrASC[array_rand($arrASC)]);
        } while (is_dir($_SERVER['DOCUMENT_ROOT'] . '/public/' . $symbol . '/' . $newNameFile));
        return $newNameFile;
    }

    private function checkRequestTime(): bool
    {
        if ((new Date((new LockFileModel())->getLastEntry($_SERVER['REMOTE_ADDR'])))->dateDiffSecond() > 10) {
            return true;
        } else
            return false;
    }


    private function getOneSymbol(int $num): string
    {
        switch ($num) {
            case 0:
                return 'S';
                break;
            case 1:
                return 'M';
                break;
            case 2:
                return 'T';
                break;
            case 3:
                return 'W';
                break;
            case 4:
                return 't';
                break;
            case 5:
                return 'F';
                break;
            case 6:
                return 's';
                break;
        }
    }

}