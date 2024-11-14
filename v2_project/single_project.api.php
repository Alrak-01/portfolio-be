<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");

include_once("../modals/project.class.php");

$response = array(
  "status" => 0,
  "message" => "file reading faiiled"
);

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (isset($_GET['id'])) {
      $response['message'] = "Id not found";
  }
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

  $project = new Project();
  $project->tableName = "tbl_project";
  $result  = $project->selectSingleProject($id);
  if ($result == 0) {
    http_response_code(500);
    $response['message'] = "Database error occurred";
  }
  else{
    $allAdmin['records'] = array();
    $rows = $result->fetch(PDO::FETCH_ASSOC);

      array_push($allAdmin['records'], array(
        "id" => $rows['id'],
        "stack" => $rows['stack'],
        "title" => $rows['title'],
        "live_link" => $rows['live_link'],
        "github_link" => $rows['github_link'],
        "date" => $rows['date']
      ));

      http_response_code(200);
      echo json_encode(array(
        "status" => 1,
        "date" => $allAdmin['records']
      ));
  }

}

else {
  http_response_code(503);
  $response['message'] = "Method not allowed";
}
echo json_encode($response);
