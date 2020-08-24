<?php


namespace application\models;

use application\core\Model;

class LockFileModel extends Model
{
    private $table = 'lock_file';

   public function saveLock( array $arr)
   {
       $time = time();
       $sql = "INSERT INTO .$this->table (ip, file, date)"
           ." VALUES (:ip, :file, :date)";
       $stmt = $this->pdo->prepare($sql);

       $stmt->bindParam(':ip', $arr['ip']);
       $stmt->bindParam(':file', $arr['name']);
       $stmt->bindParam(':date', $time);
      return $stmt->execute();
   }

   public function getLastEntry($ip)
   {
       $sql = "SELECT MAX(date) FROM $this->table "
           ."WHERE ip = :ip";

           $stmt = $this->pdo->prepare($sql);

       if ($stmt->execute([":ip" => $ip])) {
           $stmt->bindColumn(1, $ip, \PDO::PARAM_LOB);
           $result = $stmt->fetch(\PDO::FETCH_BOUND) ? $ip : null;
           return $result;
       }
   }
}