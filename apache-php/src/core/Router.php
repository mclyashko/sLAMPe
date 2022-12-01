<?php

namespace core;
use controller\AdminController;

class Router
{

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $params = parse_url($uri);

        switch ($uri) {
            case "/admin.php":
                AdminController::getState()->getAll();
                break;
        }
    }
}