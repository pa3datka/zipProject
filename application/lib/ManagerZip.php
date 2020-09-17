<?php


namespace application\lib;

use ZipArchive;

/**
 * Class ManagerZip
 * @package application\lib
 */
class ManagerZip extends AbstractManager
{


    /**
     * managerZip constructor.
     * @param array $tmpFile
     */
    public function __construct(array $tmpFile)
    {
        $this->class = new ZipArchive();
        $this->arrFiles = $tmpFile;
    }

    /**
     * @return bool
     */
    public function extractionArchive(): bool
    {
        if ($this->class->open($this->arrFiles['tmp_name'])) {
            $patch = $_SERVER['DOCUMENT_ROOT'] . '/public/' . $this->arrFiles['name']['0'];
            if (!file_exists($patch)) {
                mkdir($patch);
            }
            if ($this->class->extractTo($patch . '/' . $this->arrFiles['name'])) {
                $this->class->close();
                unlink($this->arrFiles['tmp_name']);
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function checkFileArchive(): bool
    {
        $flag = false;
        if ($this->arrFiles['error'] == 0) {
            if ($this->class->open($this->arrFiles['tmp_name'])) {
                if ($this->arrFiles['size'] < $this->fileSize) {
                    $count = $this->class->count();
                    for ($i = 0; $i <= $count; $i++) {
                        $file = $this->class->getNameIndex($i);
                        $this->deleteProhibitedFiles($file);
                        if ($file == 'index.html') {
                            $flag = true;
                        }
                    }
                }
                $this->class->close();
            }
        }
        return $flag;
    }

    /**
     * @param $file
     */
    public function deleteProhibitedFiles($file) :void
    {
        foreach ($this->arrayForbiddenExtensions as $type) {
            if (preg_match("#\.$type$#", $file)) {
                $this->class->deleteName($file);
            }
        }
    }
}