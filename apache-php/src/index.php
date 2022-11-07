<?php
require_once 'const.php';
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather Report</title>
</head>
<body>
<h1>Прогноз</h1>
<p>Прогноз на неделю:</p>
<?php
require_once 'const.php';
$mysqli = new mysqli(dbHost, dbUser, dbPass, dbName);
$weather_report = $mysqli->query('SELECT * FROM ' . tableWeatherReportName
    . ' ORDER BY ' . tableWeatherReportId);

foreach ($weather_report as $one_day_report) {
    echo <<<REPORT
        <div>
            <span>{$one_day_report[tableWeatherReportDay]}</span>
            <span>{$one_day_report[tableWeatherReportTemperature]}</span>
            <span>{$one_day_report[tableWeatherReportAbout]}</span>
        </div>
    REPORT;
}
$mysqli->close();
?>
<div>
    <a href="index.html">Главная</a>
</div>
</body>
</html>