<?php
include("../config/database.php");
class Admin extends Database{
  public $tableName;
  public $db_con;

  public function __construct(){
    $this->tableName;
    $this->db_con = self::connect();
  }

  public function selectAdmin(){
    $sql = "SELECT * FROM ".$this->tableName;
    $stmt = $this->db_con->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount() > 0 ? $stmt : 0;
  }

  public function updateAdmin($id, $data) {
    $setClause = [];
    $values = [];
    foreach ($data as $column => $value) {
        $setClause[] = "`$column` = ?";
        $values[] = $value;
    }
    $setClause = implode(', ', $setClause);
    $sql = "UPDATE ".$this->tableName." SET $setClause WHERE `id` = ?";
    $values[] = $id;
    $stmt = $this->db_con->prepare($sql);
    $stmt->execute($values);
    return $stmt ? 1 : 0;
  }
}
