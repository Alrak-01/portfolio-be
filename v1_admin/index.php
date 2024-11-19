<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch($action) {
    case "select":
    include ("select.php");
        break;

    case "update":
    include ("update.php");
        break;
    // case "login":
    // include ("login.php");
    //     break;
    default:
        http_response_code(400);
        $response['message'] = "Invalid action specified";
        break;
}
