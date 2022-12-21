<?php

namespace app\models;

use Yii;
use yii\base\Model;
use mysqli;

const tableWeatherReportName = 'weather_report', tableWeatherReportDay = 'day',
tableWeatherReportTemperature = 'temperature', tableWeatherReportAbout = 'about',
tableWeatherReportId = 'ID';

class Site extends Model
{
    static private ?Site $state = null;

    private mysqli $mysqli;

    private function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public static function getState($mysqli): ?Site
    {
        if (Site::$state == null) {
            Site::$state = new Site($mysqli);
        }

        return Site::$state;
    }

    public function getWeather(): array
    {
        $weather_report = $this->mysqli->query(
            'SELECT * FROM ' . tableWeatherReportName
            . ' ORDER BY ' . tableWeatherReportId
        );

        $result = array();

        foreach ($weather_report as $one_day_report) {
            $result[] = $one_day_report;
        }
        $this->mysqli->close();

        return $result;
    }

    public function updateWeather(): void
    {
        $q = "UPDATE " . tableWeatherReportName .
            " SET " . tableWeatherReportTemperature . " = " . $_POST['temp'] . ", " .
            tableWeatherReportAbout . " = '" . $_POST['about'] . "'" .
            " WHERE " . tableWeatherReportDay . " = '" . $_POST['day'] . "'";

        $this->mysqli->query($q);
    }

    private function read(): void
    {
        echo json_encode($this->getWeather());
    }

    private function update(): void
    {
        $data = json_decode(file_get_contents("php://input"));
        $q = "UPDATE " . tableWeatherReportName .
            " SET " . tableWeatherReportTemperature . " = " . $data->temperature . ", " .
            tableWeatherReportAbout . " = '" . $data->about . "'" .
            " WHERE " . tableWeatherReportDay . " = '" . $data->day . "'";
        $this->mysqli->query($q);
        $this->read();
    }

    private function error(): void
    {
        http_response_code(404);
        echo "FORECAST ERROR";
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