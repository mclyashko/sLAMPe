<?php

namespace controller;

use model\WeatherModel;

class WeatherController
{
    static private ?WeatherController $state = null;

    private WeatherModel $weatherModel;

    private function __construct($weatherModel)
    {
        $this->weatherModel = $weatherModel;
    }

    public static function getState($weatherModel): ?WeatherController
    {
        if (WeatherController::$state == null) {
            WeatherController::$state = new WeatherController($weatherModel);
        }

        return WeatherController::$state;
    }

    public function getWeather(): void
    {
         $weather_report = $this->weatherModel->getWeather();

         require __DIR__ . '/../view/WeatherView.php';
    }
}