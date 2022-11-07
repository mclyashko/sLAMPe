<?php
require_once '../../const.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "../config/database.php";
require_once "../objects/forecast.php";

$database = new Database();
$db = $database->getConnection();

$forecast = new Forecast($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->ID) &&
    !empty($data->day) &&
    !empty($data->temperature) &&
    !empty($data->about)
) {
    $forecast->id = $data->ID;
    $forecast->day = $data->day;
    $forecast->temperature = $data->temperature;
    $forecast->about = $data->about;

    if ($forecast->update()) {
        http_response_code(201);

        echo json_encode(array("message" => "UPDATED"));
    } else {
        http_response_code(503);

        echo json_encode(array("message" => "ERROR TO UPDATE"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "ERROR TO GET DATA"));
}