<?php


namespace Application\Core;


use Application\Lib\Db;
use PDO;

class Model
{
    private string $host = '127.0.0.1';
    private string $db = 'zip';
    private string $user = 'root';
    private string $pass = 'root';
    private string $charset = 'utf8';
    protected $pdo;


    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $opt =  [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => true,
        ];
        $this->pdo = new PDO($dsn, $this->user, $this->pass, $opt);
    }

}