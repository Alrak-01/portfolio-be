<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Method: POST");

include_once("../autoload/autoload.php");

$response = array(
  "status" => 0,
  "message" => "File reading faiiled"
);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $data = json_decode(file_get_contents("php://input"));
  if (empty($data->name) || empty($data->experience) || empty($data->status)) {
      $response['message'] = "Input field cannot be empty";
  }
  else {
    $name = htmlspecialchars(stripslashes($data->name));
    $experience = htmlspecialchars(stripslashes($data->experience));
    $status = htmlspecialchars(stripslashes($data->status));

    $result = $skill->createSkill($name, $experience, $status);
    if ($result == 0) {
        $response['message'] = "Database error occurred";
    }
    elseif($result == 1) {
        http_response_code(200);
        $response['message'] = "New skill created successfully";
        $response['status'] = 1;
    }
  }
}
else {
  $response['message'] = "Method not allowed";
}

echo json_encode($response);
