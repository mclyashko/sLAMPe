<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/admin_user.php";

$database = new Database();
$db = $database->getConnection();

$admin_user = new Admin_user($db);

// получаем id товара
$data = json_decode(file_get_contents("php://input"));

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "ERROR TO GET DATA"));
} else {
    $admin_user->id = $_GET["id"];

    $result = $admin_user->delete();

    if ($result) {
        http_response_code(200);
        echo json_encode(array("message" => "DELETED"));
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "ERROR TO DELETE"));
    }
}