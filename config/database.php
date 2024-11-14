<?php
class Database{
  private $DB_NAME;
  private $SERVER_NAME;
  private $USERNAME;
  private $PASSWORD;
  private $db_con;

  public function connect(){
    $this->USERNAME = "root";
    $this->PASSWORD = "";
    $this->SERVER_NAME = "localhost";
    $this->DB_NAME = "portfolio";

    try {
      $this->db_con = new PDO("mysql:host=".$this->SERVER_NAME.";dbname=".$this->DB_NAME, $this->USERNAME, $this->PASSWORD);
      $this->db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $this->db_con;
    } catch (\Exception $e) {
      print "Database error :". $e->getMessage();
          die();
    }
  }
}
