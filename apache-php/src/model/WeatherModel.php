<?php

namespace model;

use mysqli;

class WeatherModel
{
    static private ?WeatherModel $state = null;

    private mysqli $mysqli;

    private function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public static function getState($mysqli): ?WeatherModel
    {
        if (WeatherModel::$state == null) {
            WeatherModel::$state = new WeatherModel($mysqli);
        }

        return WeatherModel::$state;
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
//        $this->mysqli->close();

        return $result;
    }
}