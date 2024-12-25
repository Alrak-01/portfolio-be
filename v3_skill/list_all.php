<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");

// include_once("../autoload/autoload.php");
require_once("../modals/skill.class.php");
$skill = new Skill();
$skill->tableName = "tbl_skill";

// $response = array(
//   "status" => 0,
//   "message" => "File reading faiiled"
// );

if ($_SERVER['REQUEST_METHOD'] == "GET") {

  $result  = $skill->selectSkill();
  if ($result == 0) {
    http_response_code(500);
    echo json_encode(array(
      "status" => 0,
      "message" => "Database error occurred"
    ));
  }
  else{
    $allAdmin['records'] = array();
    while ($rows = $result->fetch(PDO::FETCH_ASSOC)) {
      array_push($allAdmin['records'], array(
        "id" => $rows['id'],
        "name" => $rows['name'],
        "experience" => $rows['experience'],
        "status" => $rows['status'],
        "type" => $rows['type']
      ));
    }

    http_response_code(200);
    echo json_encode(array(
      "status" => 1,
      "data" => $allAdmin['records']
    ));
  }
  }
else {
  http_response_code(503);
  echo json_encode(array(
    "status" => 0,
    "message" => "Method not allowed"
  ));
}
// echo json_encode($response);
