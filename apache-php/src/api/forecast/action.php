<?php
require_once '../../const.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "../config/database.php";
require_once "../objects/forecast.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET": read(); break;
    case "POST": create(); break;
    case "PUT": update(); break;
    case "DELETE": delete(); break;
    default: error(); break;
}

function read(): void
{
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
}

function create(): void
{
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
}

function update(): void
{
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
}

function delete(): void
{
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
}

function error(): void
{
    http_response_code(404);
    echo "FORECAST ERROR";
}