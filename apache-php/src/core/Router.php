<?php

namespace core;

use controller\AdminController;
use controller\FileController;
use controller\GraphController;
use controller\WeatherController;
use model\AdminModel;
use model\FileModel;
use model\GraphModel;
use model\WeatherModel;
use mysqli;
use MongoDB;

require_once 'Const.php';
require_once '/var/www/vendor/autoload.php';

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
            case (bool)preg_match("/admin\/weather_gui.php.*/", $uri):
                WeatherController::getState(
                    WeatherModel::getState(
                        new mysqli(dbHost, dbUser, dbPass, dbName)
                    ),
                )->updateWeather();
                break;
            case (bool)preg_match("/admin\/weather.php.*/", $uri):
                WeatherController::getState(
                    WeatherModel::getState(
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
            case (bool)preg_match("/file_get.php.*/", $uri):
                require_once '/var/www/vendor/autoload.php';

                $mongo_host = 'mongodb';
                $mongo_port = '27017';
                $mongo_database = 'appMongoDatabase';
                $mongo_collection = 'appFileCollection';
                // Недостающие элементы устанавливаются в контейнере через composer
                $client = new MongoDB\Client("mongodb://{$mongo_host}:{$mongo_port}");

                $mongo_db = $client->selectDatabase($mongo_database);
                $collection = $mongo_db->selectCollection($mongo_collection);
                FileController::getState(
                    FileModel::getState(
                        $collection
                    )
                )->getFile();
            case (bool)preg_match("/file_put.php.*/", $uri):
                require_once '/var/www/vendor/autoload.php';

                $mongo_host = 'mongodb';
                $mongo_port = '27017';
                $mongo_database = 'appMongoDatabase';
                $mongo_collection = 'appFileCollection';
                // Недостающие элементы устанавливаются в контейнере через composer
                $client = new MongoDB\Client("mongodb://{$mongo_host}:{$mongo_port}");

                $mongo_db = $client->selectDatabase($mongo_database);
                $collection = $mongo_db->selectCollection($mongo_collection);
                FileController::getState(
                    FileModel::getState(
                        $collection
                    )
                )->putFile();
                break;
            case (bool)preg_match("/file.php.*/", $uri):
                require_once '/var/www/vendor/autoload.php';

                $mongo_host = 'mongodb';
                $mongo_port = '27017';
                $mongo_database = 'appMongoDatabase';
                $mongo_collection = 'appFileCollection';
                // Недостающие элементы устанавливаются в контейнере через composer
                $client = new MongoDB\Client("mongodb://{$mongo_host}:{$mongo_port}");

                $mongo_db = $client->selectDatabase($mongo_database);
                $collection = $mongo_db->selectCollection($mongo_collection);
                FileController::getState(
                    FileModel::getState(
                        $collection
                    )
                )->getFilePage();
                break;
            case (bool)preg_match("/graphs.php.*/", $uri):
                GraphController::getState(
                    GraphModel::getState()
                )->printGraphs();
                break;
        }
    }
}