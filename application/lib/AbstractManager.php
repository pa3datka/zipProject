<?php


namespace application\lib;


abstract class AbstractManager
{
    protected int $fileSize = 20971520;
    protected array $arrFiles = [];
    protected array $arrayForbiddenExtensions = [
    'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 'aspx', 'shtml',
     'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'htm', 'sql', 'spl', 'scgi', 'fcgi'
];
    protected object $class;

    abstract public function extractionArchive() :bool ;

    abstract public function checkFileArchive() :bool ;

    abstract public function deleteProhibitedFiles($file);
}