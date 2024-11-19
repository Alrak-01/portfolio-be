<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Method: GET");

include_once("../modals/admin.class.php");

$admin = new Admin();
$admin->tableName = "tbl_admin";

if ($_SERVER['REQUEST_METHOD'] == "GET") {

$result = $admin->selectAdmin();
if ($result == 0) {
    http_response_code(503);
    echo json_encode(array(
      "status" => 0,
      "message" => "Database error occurred"
    ));
}
else {
        $allAdmin['records'] = array();
        $rows = $result->fetch(PDO::FETCH_ASSOC);
            array_push($allAdmin['records'], array(
              "id" => $rows['id'],
              "email" => $rows['email'],
              "lastname" => $rows['lastname'],
              "firstname" => $rows['firstname'],
              "middlename" => $rows['middlename'],
              "mobile" => $rows['mobile'],
              "about_me" => $rows['about_me'],
              "linkedln" => $rows['linkedln'],
              "github" => $rows['github'],
              "whatsapp" => $rows['whatsapp'],
              "skype" => $rows['skype'],
              "filename" => $rows['filename'],
            ));
        }
        http_response_code(200);
        echo json_encode(array(
          "status" => 1,
          "data" => $allAdmin['records']
        ));
}
else {
  http_response_code(404);
  echo json_encode(array(
    "status" => 0,
    "message" => "Access denied"
  ));
}
