<?php
include("../config/database.php");
class Login extends Database{
  public $tableName;
  public $db_con;

  public function __construct(){
    $this->tableName;
    $this->db_con = self::connect();
  }

  public function loginAdmin($email, $password){
    $sql = "SELECT * FROM ".$this->tableName." WHERE `email` = ?";
    $stmt = $this->db_con->prepare($sql);
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $dbPassword = $row['password'];
      if ($password == $dbPassword) {
          return $row;
      }
      else {
        return 10;
        // PASSWORD DOES NOT MATCH...
      }
    }
    else {
      return 0;
      // EMAIL ADDRESS NOT FOUND IN DATABASE
    }
  }
}
