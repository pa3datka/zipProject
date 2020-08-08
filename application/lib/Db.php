<?php


namespace Application\Lib;


use PDO;

class Db
{
    private $host = '127.0.0.1';
    private $db   = 'zipProject';
    private $user = 'root';
    private $pass = 'root';
     private $charset = 'utf8';
    private $pdo;
   protected static $_instance = null;



    public static function getInstance()
    {
        if ( self::$_instance === null) {
            return self::$_instance = new Db();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt =  [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => true,
        ];
        $this->pdo = new PDO($dsn, $this->user, $this->pass, $opt);
    }

    public function getPDO()
    {
        //return $this->pdo;
        echo 'db';
    }

}