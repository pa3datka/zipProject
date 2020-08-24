<?php


namespace application\lib;


use ZipArchive;

class ZipManager extends ZipArchive
{
    private $arrayForbiddenExtensions = [
        'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 'aspx', 'shtml',
        'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'htm', 'sql', 'spl', 'scgi', 'fcgi'
    ];

    private $arrFile = [];
    private $sizeZip = 20971520;

    public function __construct($arrFile)
    {
        $this->arrFile = $arrFile;
    }

    public function extractionZip($pathDir, $fileName, $dir)
    {
        $patch = $_SERVER['DOCUMENT_ROOT'] . '/public/'. $dir;
        if (!is_dir($patch)) {
            mkdir($patch);
        }
        if ($this->open($pathDir )) {
            if ($this->extractTo($patch . '/' . $fileName)) {
                $this->close();
                unlink($pathDir);
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

 //-----------------//
    public function checkFileZip()
    {
        $flag = false;
        if ($this->arrFile['error'] == 0) {
            if ($this->open($this->arrFile['tmp_name'])) {
                if ($this->arrFile['size'] < $this->sizeZip) {
                    $count = $this->count();
                    for ($i = 0; $i <= $count; $i++) {
                        $file = $this->getNameIndex($i);
                        $this->deleteProhibitedFiles($file);
                        if ($file == 'index.html') {
                            $flag = true;
                        }
                    }
                }
            }
        }
        return $flag;
    }

    private function deleteProhibitedFiles($file)
    {
        foreach ($this->arrayForbiddenExtensions as $type) {
            if (preg_match("#\.$type$#", $file)) {
               $this->deleteName($file);
            }
        }
    }

}

