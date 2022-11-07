<?php
if (!isset($_SESSION)) {
    session_start();
}

const dbHost = 'mysql', dbUser = 'user', dbPass = 'password', dbName = 'appDB';
const tableWeatherReportName = 'weather_report', tableWeatherReportDay = 'day',
tableWeatherReportTemperature = 'temperature', tableWeatherReportAbout = 'about',
tableWeatherReportId = 'ID';
const tableUserName = 'users', tableUserId = 'ID', tableUserLogin = 'login', tableUserPassword = 'password';
const days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
const dayAbouts = array('good', 'normal', 'bad');