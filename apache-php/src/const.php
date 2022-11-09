<?php
require_once 'env.php';

const dbHost = 'mysql', dbUser = 'user', dbPass = 'password', dbName = 'appDB';
const tableWeatherReportName = 'weather_report', tableWeatherReportDay = 'day',
tableWeatherReportTemperature = 'temperature', tableWeatherReportAbout = 'about',
tableWeatherReportId = 'ID';
const tableUserName = 'users', tableUserId = 'ID', tableUserLogin = 'login', tableUserPassword = 'password';
const days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
const dayAbouts = array('good', 'normal', 'bad');
const session_login = 'login';
const session_theme = 'theme';
const session_enlarged_font = 'font';

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

if (!isset($_SESSION)) {
    session_start();

    set_theme();
    set_enlarged_font();
}