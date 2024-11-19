<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Method: POST");

include_once("../autoload/autoload.php");

$response = array(
  "status" => 0,
  "message" => "file reading faiiled"
);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $data = json_decode(file_get_contents("php://input"));

  if (empty($data->stack) || empty($data->title) || empty($data->live_link) || empty($data->github_link)) {
    http_response_code(502);
      $response['message'] = "Input field cannot be empty";
  }
  else {
    $stack = htmlspecialchars(stripslashes($data->stack));
    $title = htmlspecialchars(stripslashes($data->title));
    $live = htmlspecialchars(stripslashes($data->live_link));
    $github = htmlspecialchars(stripslashes($data->github_link));
    $date = date("Y");

    $result = $project->createProject($stack, $title, $live, $github, $date);
    if ($result == 0) {
      http_response_code(500);
        $response['messagee'] = "Database error occurred";
    }
    elseif ($result == 1) {
      http_response_code(200);
        $response['message'] = "Project created successfully";
        $response['status'] = 1;
    }
  }
}
else {
  http_response_code(503);
  $response['message'] = "Method not allowed";
 }

echo json_encode($response);
