<?php

include_once "../config/database.php";
include_once "../objects/admin_user.php";

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

    $admin_user = new Admin_user($db);

    $data = $admin_user->read();

    if (is_bool($data)) {
        http_response_code(404);
        echo json_encode(array("message" => "ERROR TO READ"));
    } else {
        $data_to_encode = array();
        $data_to_encode["admin_users"] = array();

        foreach ($data as $admin_user_data) {
            $admin_user_element = array(
                "ID" => $admin_user_data["id"],
                "login" => $admin_user_data["login"],
                "password" => $admin_user_data["password"]
            );

            $data_to_encode["admin_users"][] = $admin_user_element;
        }

        http_response_code(200);
        echo json_encode($data_to_encode);
    }
}

function create(): void
{
    $database = new Database();
    $db = $database->getConnection();

    $admin_user = new Admin_user($db);

    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data->login) &&
        !empty($data->password)
    ) {
        $admin_user->login = $data->login;
        $admin_user->password = $data->password;

        if ($admin_user->create()) {
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

    $admin_user = new Admin_user($db);

    $data = json_decode(file_get_contents("php://input"));

    if (
        !empty($data->ID) &&
        !empty($data->login) &&
        !empty($data->password)
    ) {
        $admin_user->id = $data->ID;
        $admin_user->login = $data->login;
        $admin_user->password = $data->password;

        if ($admin_user->update()) {
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

    $admin_user = new Admin_user($db);

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
}

function error(): void
{
    http_response_code(404);
    echo "ADMIN_USER ERROR";
}