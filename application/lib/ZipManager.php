<?php


namespace Application\Lib;


use ZipArchive;

class ZipManager extends ZipArchive
{
    private $arrayForbiddenExtensions = [
        'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 'aspx', 'shtml',
        'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'htm', 'sql', 'spl', 'scgi', 'fcgi'
    ];

    private $arrFile = [];
    private $sizeZip = 1024000;

    public function __construct($arrFile = null)
    {
        $this->arrFile = $arrFile;
    }

    public function extractionZip($pathDir, $fileName)
    {
        if ($this->open($pathDir . '.zip')) {
            if ($this->extractTo($_SERVER['DOCUMENT_ROOT'] . '/public/' . $fileName)) {
                $this->close();
                unlink($pathDir . '.zip');
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
                        if ($file == 'index.html') {
                            $this->deleteProhibitedFiles($file);
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

