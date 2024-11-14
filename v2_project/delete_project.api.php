<?php
header("Access-Control-Allow-origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Method: POST");

include_once("../modals/project.class.php");

$response = array(
  "status" => 0,
  "message" => "file reading faiiled"
);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $data = json_decode(file_get_contents("php://input"));
  if (empty($data->id)) {
    http_response_code(500);
    $response['message'] = "Id not found";
  }
  else {
    $id = htmlspecialchars(stripslashes($data->id));
    $project = new Project();
    $project->tableName = "tbl_project";
    $result = $project->deleteProject($id);
    if ($result == 0) {
      http_response_code(500);
      $response['message'] = "Database error occurred";
    }
    elseif ($result == 1) {
      http_response_code(200);
      $response['message'] = "Project deleted successfully";
      $response['status'] = 1;
    }
  }
}
else {
  http_response_code(503);
  $response['message'] = "Method not allowed";
}

echo json_encode($response);
