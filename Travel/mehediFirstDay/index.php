<?php
include('conn.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);



switch ($method) {
    case 'GET':
        include('get.php');
        handleGetRequest();
        break;
    case 'POST':
        include('post.php');
        handlePostRequest($input);
        break;
    case 'PUT':
        include('put.php');
        handlePutRequest($input);
        break;
    case 'DELETE':
        include('delete.php');
        handleDeleteRequest($input);
        break;
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Invalid Method"));
        break;
}


$conn = connection();
$conn->close();





?>
