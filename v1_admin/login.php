<?php
  require '../vendor/autoload.php';
  use \Firebase\JWT\JWT;

  header("Access-Control-Allow-Origin: *");
  // ALLOW FROM ALL ACCESS LOCALHOST/DOMIN/SUBDOMAIN
  header("Content-type:application/json; charset=UTF -8");
  // JSON DATA ARE ACCEPT FROM REQUEST
  header("Access-Control-Allow-Methods: POST");
  // ONLY POST METHOD IS ALLOWED

include_once("../modals/login.class.php");

$login = new Login();
$login->tableName = "tbl_admin";

$response = array(
  "status" => 0,
  "message" => "Form submission Failled",
  "jwt" => ""
);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $data = json_decode(file_get_contents("php://input"));

  if (empty($data->email) && empty($data->password)) {
    http_response_code(404);
    $response['message'] = "FIELD CANNOT BE EMPTY";
  }
  else {

      $email = $data->email;
      $password = $data->password;

      $email = trim(htmlspecialchars(stripslashes($data->email)));
      $password = trim(htmlspecialchars(stripslashes($data->password)));

      $result = $login->loginAdmin($email, $password);
      if ($result == 0 || $result == 10) {
        http_response_code(503);
        $response['message'] = "Wrong Login Info";
      }
      else {
        $iss = "localhost";
        $iat = time();
        $nbf = $iat + 10;
        $exp = $iat + 30;
        $aud = "myusers";
        $data = array(
          "id" => $result['id'],
          "lastname" => $result['lastname'],
          "middlename" => $result['middlename'],
          "email" => $result['email']
        );

        $secretKey = "owt1234567890";

        $payload = array(
            "iss" => $iss,
            "iat" => $iat,
            "nbf" => $nbf,
            "exp" => $exp,
            "aud" => $aud,
            "data" => $data
        );

        $jwt = JWT::encode($payload, $secretKey, "HS512");

        http_response_code(200);
        $response['status'] = 1;
        $response['message'] = $result['lastname'];
        $response['jwt'] = $jwt;
      }
  }
}
else {
  http_response_code(502);
  $response['message'] = "ONLY POST METHODS ALLOWED";
}

echo json_encode($response);
