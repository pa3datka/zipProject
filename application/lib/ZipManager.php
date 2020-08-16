<?php


namespace Application\Lib;


use ZipArchive;

class ZipManager extends ZipArchive
{
    private $arrayForbiddenExtensions = [
        'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 'aspx', 'shtml',
        'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'htm', 'sql', 'spl', 'scgi', 'fcgi'
    ];

    public function retrievedZip($pathDir, $fileName)
    {
        if ($this->open($pathDir.'.zip')) {
            if ($this->extractTo($_SERVER['DOCUMENT_ROOT'].'/public/'.$fileName)) {
                $this->close();
                unlink($pathDir.'.zip');
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function checkZip(array $arrFile)
    {
        $flag = false;
        if ($this->open($arrFile['tmp_name'])) {
            $count = $this->count();
            for ($i = 0; $i<= $count; $i++) {
                $file = $this->getNameIndex($i);
                if ($file == 'index.html') {
                    $flag = true;
                }
                if ($this->comparisonTypes($file)) {
                    $this->deleteName($file);
                }
            }
            $this->close();
        }
        return $flag;
    }

    private  function comparisonTypes($file) {
        foreach ($this->arrayForbiddenExtensions as $type) {
            if (preg_match("#\.$type$#", $file)) {
                return true;
            }
        }
        return false;
    }

}

