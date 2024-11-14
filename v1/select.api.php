<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

include_once("../modals/admin.class.php");

$response = array(
  "status" => 0,
  "message" => "file reading faiiled"
);

$admin = new Admin();
$admin->tableName = "tbl_admin";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
$result = $admin->selectAdmin();
if ($result == 0) {
    http_response_code(503);
    $response['message'] = "Database error occurred";
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
              "mobile" => $rows['mobile']
            ));
        }

        http_response_code(200);
        echo json_encode(array(
          "status" => 1,
          "date" => $allAdmin['records']
        ));
}
else {
  http_response_code(404);
  $response['message'] = "Access denied";
}

echo json_encode($response);
