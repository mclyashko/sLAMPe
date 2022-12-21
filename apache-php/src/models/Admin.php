<?php

namespace app\models;

use Yii;
use yii\base\Model;
use mysqli;

const tableUserName = 'users', tableUserId = 'ID', tableUserLogin = 'login', tableUserPassword = 'password';
const days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
const dayAbouts = array('good', 'normal', 'bad');

class Admin extends Model
{

    static private ?Admin $state = null;

    private mysqli $mysqli;

    private function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public static function getState($mysqli): ?Admin
    {
        if (Admin::$state == null) {
            Admin::$state = new Admin($mysqli);
        }

        return Admin::$state;
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