<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Method: PUT");

include_once("../autoload/autoload..php");

$response = array(
  "status" => 0,
  "message" => "File reading faiiled"
);

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
  $data = json_decode(file_get_contents("php://input"));

  if (!isset($data->id)) {
      http_response_code(400);
      $response['message'] = "Id not found";
  }
  elseif (empty($data->name) || empty($data->experience) || empty($data->status)) {
      http_response_code(400);
      $response['message'] = "Input field cannot be empty";
  }
  else {
    $id = htmlspecialchars(stripslashes($data->id));
    $name = htmlspecialchars(stripslashes($data->name));
    $experience = htmlspecialchars(stripslashes($data->experience));
    $status = htmlspecialchars(stripslashes($data->status));

    $result = $skill->updateSkill($id, $name, $experience, $status);

    if ($result == 0) {
        http_response_code(500);
        $response['message'] = "Database error occurred";
    }
    elseif ($result == 1) {
        http_response_code(200);
        $response['message'] = "Project updated successfully";
        $response['status'] = 1;
    }
  }
}
else {
  http_response_code(503);
  $response['message'] = "Method not allowed";
}
echo json_encode($response);
