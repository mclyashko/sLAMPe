<?php

use core\Router;

require_once 'core/Const.php';

spl_autoload_register(function ($class) { //autoload classes
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});

session_start();

// сквозная функциональность сессий

function set_theme(): void
{
    if (isset($_SESSION[session_theme]) and $_SESSION[session_theme]) {
        echo <<< DARK_THEME
        <style>
            body {
                background-color: black !important;
                color: white !important;
            }
        </style>
        DARK_THEME;
    }
}

function set_enlarged_font(): void
{
    if (isset($_SESSION[session_enlarged_font]) and $_SESSION[session_enlarged_font]) {
        echo <<< ENLARGED_FONT
        <style>
            body {
                font-size: xx-large; !important;
            }
        </style>
        ENLARGED_FONT;
    }
}

if (!preg_match("/file_get.php.*/", $_SERVER['REQUEST_URI'])) {
    set_theme();
    set_enlarged_font();
}
// сквозная функциональность сессий

$router = new Router;
$router->run();