<?php


namespace application\lib;

<<<<<<< HEAD
/**
 * Class FileManager
 * @package application\lib
 */
class FileManager
{
    /**
     * @return void
     */
=======

class FileManager
{
>>>>>>> 13952c4ca0408ef324bb756bd17f17f81e194151
    public function checkDir() :void
    {
        $count = file_get_contents('application/txtFile/counterSaveFile.txt');
        if ($count >= 10) {
            $path = $_SERVER['DOCUMENT_ROOT'] .DIRECTORY_SEPARATOR. 'public';
            $arrDir = array_diff(scandir($path), ['.', '..']);
            foreach ($arrDir as $dir) {
                $time = date_create(date('Y-m-d', filemtime('public/' . $dir)));
                if ((new Date($time->getTimestamp()))->dateDiffDay() >= 7) {
                   $this->rmRec($path . DIRECTORY_SEPARATOR . $dir);
                }
            }
            file_put_contents('application/txtFile/counterSaveFile.txt', 0);
        } else {
            ++$count;
            file_put_contents('application/txtFile/counterSaveFile.txt',$count);
        }
    }

<<<<<<< HEAD
    /**
     * @param $path
     */
=======
>>>>>>> 13952c4ca0408ef324bb756bd17f17f81e194151
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