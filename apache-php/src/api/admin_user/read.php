<?php

// Требуемые HTTP-заголовки

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config/database.php";
include_once "../objects/admin_user.php";

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
            "ID" => $admin_user_data["ID"],
            "login" => $admin_user_data["login"],
            "password" => $admin_user_data["password"]
        );

        $data_to_encode["admin_users"][][] = $admin_user_element;
    }

    http_response_code(200);
    echo json_encode($data_to_encode);
}