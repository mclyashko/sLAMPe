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

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->day) &&
    !empty($data->temperature) &&
    !empty($data->about)
) {
    $forecast->day = $data->day;
    $forecast->temperature = $data->temperature;
    $forecast->about = $data->about;

    if ($forecast->create()) {
        http_response_code(201);

        echo json_encode(array("message" => "ADDED"));
    }
    else {
        http_response_code(503);

        echo json_encode(array("message" => "ERROR TO ADD"));
    }
}
else {
    http_response_code(400);
    echo json_encode(array("message" => "ERROR TO GET DATA"));
}