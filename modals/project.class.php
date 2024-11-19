<?php
require_once("../config/database.php");

class Project extends Database{
  public $tableName;
  public $db_con;

  public function __construct(){
    $this->tableName;
    $this->db_con = self::connect();
  }

  public function createProject($stack, $title, $live_link, $github_link, $date){
    $sql = "INSERT INTO ".$this->tableName." (`stack`, `title`, `live_link`, `github_link`, `date`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->db_con->prepare($sql);
    $stmt->execute([$stack, $title, $live_link, $github_link, $date]);
    return $stmt ? 1 : 0;
  }

  public function selectProject(){
    $sql = "SELECT * FROM ".$this->tableName;
    $stmt = $this->db_con->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount() > 0 ? $stmt : 0;
  }

  public function selectSingleProject($id){
    $sql = "SELECT * FROM ".$this->tableName." WHERE `id` = ?";
    $stmt = $this->db_con->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->rowCount() > 0 ? $stmt : 0;
  }

  public function updateProject($id, $stack, $title, $live_link, $github_link){
    $sql = "UPDATE ".$this->tableName." SET `stack` = ?, `title` = ?, `live_link` = ?, `github_link` = ? WHERE `id` = ?";
    $stmt = $this->db_con->prepare($sql);
    $stmt->execute([$stack, $title, $live_link, $github_link, $id]);
    return $stmt ? 1 : 0;
  }

  public function deleteProject($id){
    $sql = "DELETE FROM ".$this->tableName." WHERE `id` = ?";
    $stmt = $this->db_con->prepare($sql);
    $stmt->execute([$id]);
    return $stmt ? 1 : 0;
  }
}
