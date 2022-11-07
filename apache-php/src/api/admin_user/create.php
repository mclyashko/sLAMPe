<?php
require_once '../../const.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once "../config/database.php";
require_once "../objects/admin_user.php";

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