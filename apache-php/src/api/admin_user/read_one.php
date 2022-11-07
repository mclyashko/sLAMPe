<?php
require_once '../../const.php';

header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Credentials: true");

require_once "../config/database.php";
require_once "../objects/admin_user.php";

$database = new Database();
$db = $database->getConnection();

$admin_user = new Admin_user($db);

if (!isset($_GET["id"])) {
    http_response_code(400);
    echo json_encode(array("message" => "ERROR TO GET DATA"));
} else {
    $admin_user->id = $_GET["id"];

    $admin_user_found = $admin_user->readOne()->fetch_array();

    if ($admin_user_found != null) {
        $result = array(
            "ID" => $admin_user_found["id"],
            "login" => $admin_user_found["login"],
            "password" => $admin_user_found["password"]
        );
        http_response_code(200);
        echo json_encode($result);
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "ERROR TO FIND"));
    }
}