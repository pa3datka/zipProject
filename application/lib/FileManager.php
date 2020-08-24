<?php


namespace application\lib;


class FileManager
{
    public function checkDir() :void
    {
        $count = file_get_contents('application/txtFile/counter.txt');
        if ($count >= 10) {
            $path = $_SERVER['DOCUMENT_ROOT'] .DIRECTORY_SEPARATOR. 'public';
            $arrDir = array_diff(scandir($path), ['.', '..']);
            foreach ($arrDir as $dir) {
                $time = date_create(date('Y-m-d', filemtime('public/' . $dir)));
                if ((new Date($time->getTimestamp()))->dateDiffDay() >= 7) {
                   $this->rmRec($path . DIRECTORY_SEPARATOR . $dir);
                }
            }
            file_put_contents('application/txtFile/counter.txt', 0);
        } else {
            ++$count;
            file_put_contents('application/txtFile/counter.txt',$count);
        }
    }

    public function rmRec($path) :void
    {
        if (is_file($path)) unlink($path);
        if (is_dir($path)) {
            $arr = array_diff(scandir($path), ['.', '..']);
            foreach ($arr as $p) {
                $path1 = $path . DIRECTORY_SEPARATOR . $p;
                if (is_file($path1)) unlink($path1);
                  $this->rmRec($path1);
                    if (is_dir($path1)) {
                        rmdir($path1);
                    }
            }
             rmdir($path);
        }
    }

}