<?php
header("Access-Control-Allow-Origin: *");
header("Content-type:application/json; charset=UFT -8");
header("Access-Comtrol-Allow-Methods: PUT");

include_once("../autoload/autoload.php");

$response = array(
  "status" => 0,
  "message" => "Form submission failed"
);

if ($_SERVER['REQUEST_METHOD'] === "PUT") {
  $data = json_decode(file_get_contents("php://input"));


  // if (empty($data->lastname) || empty($data->middlename) || empty($data->firstname) || empty($data->mobile)) {
    if (empty($data->lastname)) {

      http_response_code(503);
      $response['message'] = "Input field cannot be empty";
  }
  else {
    $lastname = $data->lastname;
    $firstname = $data->firstname;
    $middlename = $data->middlename;
    $mobile = $data->mobile;
    $aboutme = $data->about_me;

    $data = [
      "lastname" => $lastname,
      // "firstname" => $firstname,
      // "middlename" => $middlename,
      // "mobile" => $mobile,
      "about_me" => $aboutme
    ];
    $id = 1;
    $result = $admin->updateAdmin($id, $data);
    if ($result == 0) {
      http_response_code(502);
      $response['message'] = "Database error occurred";
    }
    elseif ($result == 1) {
      $response['status'] = 1;
      $response['message'] = "Updated successfully";
    }
  }
}
else {
  http_response_code(404);
  $response['message'] = "Wrong Method";
}

echo json_encode($response);
