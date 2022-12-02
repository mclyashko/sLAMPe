<?php

namespace model;

use mysqli;

class AdminModel
{
    static private ?AdminModel $state = null;

    private mysqli $mysqli;

    private function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public static function getState($mysqli): ?AdminModel
    {
        if (AdminModel::$state == null) {
            AdminModel::$state = new AdminModel($mysqli);
        }

        return AdminModel::$state;
    }

    public function getAll(): array
    {
        $q = "SELECT * FROM " . tableUserName;

        $users = $this->mysqli->query($q);

        $result = array();
        foreach ($users as $user) {
            $result[] = $user;
        }

        return $result;
    }

    private function read(): void
    {
        echo json_encode($this->getAll());
    }

    private function update(): void
    {
        $data = json_decode(file_get_contents("php://input"));

        $query = "
        UPDATE
            users AS u
        SET
            u.login = '" . $data->login . "',
            u.password = '" . $data->password . "'
        WHERE
            u.id = '" . $data->ID . "'
        ";

        $this->mysqli->query($query);
        $this->read();
    }

    private function error(): void
    {
        http_response_code(404);
        echo "USER ERROR";
    }

    public function api(): void
    {
        require_once 'core/Const.php';

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $this->read();
                break;
            case "PUT":
                $this->update();
                break;
            default:
                $this->error();
                break;
        }
    }
}

?>