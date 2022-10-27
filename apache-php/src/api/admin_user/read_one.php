<?php

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");

include_once "../config/database.php";
include_once "../objects/admin_user.php";

$database = new Database();
$db = $database->getConnection();

$admin_user = new Admin_user($db);

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "ERROR TO GET DATA"));
} else {
    $admin_user->ID = $_GET["id"];

    $admin_user_found = $admin_user->readOne();

    if ($admin_user_found instanceof mysqli_result) {
        $result = array(
            "id" => $admin_user_found[0],
            "login" => $admin_user_found[1],
            "password" => $admin_user_found[2]
        );
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "ERROR TO FIND"));
    }
}