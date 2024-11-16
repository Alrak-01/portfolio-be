<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");

include_once("../autoload/autoload.php");

// $response = array(
//   "status" => 0,
//   "message" => "File reading faiiled"
// );

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  $result  = $project->selectproject();
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
        "stack" => $rows['stack'],
        "title" => $rows['title'],
        "live_link" => $rows['live_link'],
        "github_link" => $rows['github_link'],
        "date" => $rows['date']
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
