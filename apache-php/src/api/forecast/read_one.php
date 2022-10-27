<?php

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");

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

    $forecast_found = $forecast->readOne()->fetch_array();

    if ($forecast_found != null) {
        $result = array(
            "ID" => $forecast_found["id"],
            "day" => $forecast_found["day"],
            "temperature" => $forecast_found["temperature"],
            "about" => $forecast_found["about"]
        );
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "ERROR TO FIND"));
    }
}