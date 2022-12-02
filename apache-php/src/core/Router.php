<?php

namespace core;

use controller\AdminController;
use controller\WeatherController;
use model\AdminModel;
use model\WeatherModel;
use mysqli;

require_once 'Const.php';

class Router
{

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $params = parse_url($uri);

        switch ($uri) {
            case "/admin/admin.php":
                AdminController::getState(
                    AdminModel::getState(
                        new mysqli(dbHost, dbUser, dbPass, dbName)
                    )
                )->getAll();
                break;
            case (bool)preg_match("/index.php.*/", $uri):
                WeatherController::getState(
                    WeatherModel::getState(
                        new mysqli(dbHost, dbUser, dbPass, dbName)
                    ),
                )->getWeather();
                break;
            case (bool)preg_match("/admin\/weather.php.*/", $uri):
                WeatherController::getState(
                    AdminModel::getState(
                        new mysqli(dbHost, dbUser, dbPass, dbName)
                    ),
                )->api();
                break;
            case (bool)preg_match("/admin\/users.php.*/", $uri):
                AdminController::getState(
                    AdminModel::getState(
                        new mysqli(dbHost, dbUser, dbPass, dbName)
                    ),
                )->api();
                break;
            case (bool)preg_match("/forecast.php.*/", $uri):
                WeatherController::getState(
                    WeatherModel::getState(
                        new mysqli(dbHost, dbUser, dbPass, dbName)
                    )
                )->api();
                break;
        }
    }
}