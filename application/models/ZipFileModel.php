<?php

namespace Application\Models;

use Application\Core\Model;
use PDO;

class ZipFileModel extends Model
{

    private $table = 'zip_file';

    public function saveZip(array $arr)
    {
        $time = time();
        $sql = "INSERT INTO $this->table(name, type, file, date)"."VALUES(:name, :type, :file, :date)";
        $getContent = file_get_contents($arr['tmp_name']);
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':name', $arr['name']);
        $stmt->bindParam(':type', $arr['type']);
        $stmt->bindParam(':file', $getContent);
        $stmt->bindParam(':date', $time);

        return $stmt->execute();
    }

    public function umploadZip($name)
    {
        $sql = "SELECT file FROM " . $this->table . " WHERE name = :name";
        $file = null;
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute([":name" => $name])) {
            $stmt->bindColumn(1, $file, \PDO::PARAM_LOB);
            $result = $stmt->fetch(\PDO::FETCH_BOUND) ? $file : null;
            return $result;
        } else
            return false;
    }
}