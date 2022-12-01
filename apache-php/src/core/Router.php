<?php

namespace core;

use controller\AdminController;
use model\AdminModel;
use mysqli;

require_once 'Const.php';

class Router
{

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $params = parse_url($uri);

        switch ($uri) {
            case "/admin.php":
                AdminController::getState(
                    AdminModel::getState(
                        new mysqli(dbHost, dbUser, dbPass, dbName)
                    )
                )->getAll();
                break;
            case "":
                break;
        }
    }
}