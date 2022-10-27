<?php

// Требуемые HTTP-заголовки

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/forecast.php";

$database = new Database();
$db = $database->getConnection();

$forecast = new Forecast($db);

$data = $forecast->read();

if (is_bool($data)) {
    http_response_code(404);
    echo json_encode(array("message" => "ERROR TO READ"));
} else {
    $data_to_encode = array();
    $data_to_encode["forecasts"] = array();

    foreach ($data as $forecast_data) {
        $forecast_element = array(
            "ID" => $forecast_data["id"],
            "day" => $forecast_data["day"],
            "temperature" => $forecast_data["temperature"],
            "about" => $forecast_data["about"]
        );

        $data_to_encode["forecasts"][] = $forecast_element;
    }

    http_response_code(200);
    echo json_encode($data_to_encode);
}