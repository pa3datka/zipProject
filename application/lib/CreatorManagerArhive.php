<?php


namespace application\lib;
use application\lib\ManagerZip;

/**
 * Class CreatorManagerArhive
 * @package application\lib
 */
class CreatorManagerArhive
{
    private array $arrayExpansions = ['zip' => 'application/x-zip-compressed'];
    public object $class;

    /**
     * CreatorManagerArhive constructor.
     * @param $tmpFile
     */
    public function createObject($tmpFile)
    {
        if ($tmpFile['type'] == $this->arrayExpansions['zip']) {
           return $this->class = new ManagerZip($tmpFile);
        }
    }
}