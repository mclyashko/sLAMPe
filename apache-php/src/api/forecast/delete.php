<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../config/database.php";
include_once "../objects/forecast.php";

$database = new Database();
$db = $database->getConnection();

$forecast = new Forecast($db);

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "ERROR TO GET DATA"));
} else {
    $forecast->id = $_GET["id"];

    $result = $forecast->delete();

    if ($result) {
        http_response_code(200);
        echo json_encode(array("message" => "DELETED"));
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "ERROR TO DELETE"));
    }
}