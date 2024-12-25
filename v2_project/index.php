<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


$action = isset($_GET['action']) ? $_GET['action'] : null;

switch($action) {
    case "create":
      include ("create.php"); 
        break;

    case "listAll":
    include ("list_all.php");
        break;

    case "listSingle":
    include ("list_single.php");
        break;

    case "update":
    include ("update.php");
        break;

    case "delete":
    include ("delete.php");
        break;

    default:
        http_response_code(400);
        $response['message'] = "Invalid action specified";
        break;
}

// echo json_encode($response);
