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

    private function read()
    {
        return json_encode($this->getAll());
    }

    private function update()
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
        return $this->read();
    }

    private function error()
    {
        http_response_code(404);
        return "USER ERROR";
    }

    public function api()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                return $this->read();
            case "PUT":
                return $this->update();
            default:
                return $this->error();
        }
    }
}