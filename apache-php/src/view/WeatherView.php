<?php
require_once 'core/Const.php';

if (isset($_POST[session_login])) {
    $_SESSION[session_login] = $_POST[session_login];
    echo "<meta http-equiv='refresh' content='0 index.php'>";
}
if (isset($_GET[session_theme])) {
    $_SESSION[session_theme] = $_GET[session_theme];
    echo "<meta http-equiv='refresh' content='0 index.php'>";
}
if (isset($_GET[session_enlarged_font])) {
    $_SESSION[session_enlarged_font] = $_GET[session_enlarged_font];
    echo "<meta http-equiv='refresh' content='0 index.php'>";
}
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

    <?php
    if (isset($_SESSION[session_login])) {
        echo "Ваш сессионный логин установлен в значение: " . $_SESSION[session_login];
    }
    ?>

    <form action="index.php" method="post">
        <input placeholder="Ваш логин" name="login">
        <button type="submit">Установить логин</button>
    </form>

    <ul>
        <li><a href="index.php?theme=1">Установить темную тему</a></li>
        <li><a href="individual_session_content.php?theme=0">Установить светлую тему</a></li>

        <li><a href="index.php?font=1">Установить увеличенный шрифт</a></li>
        <li><a href="index.php?font=0">Установить обычный шрифт</a></li>
    </ul>

    </body>
    </html>

<?php

foreach ($weather_report as $one_day_report) {
    echo <<<REPORT
        <div>
            <span>{$one_day_report[tableWeatherReportDay]}</span>
            <span>{$one_day_report[tableWeatherReportTemperature]}</span>
            <span>{$one_day_report[tableWeatherReportAbout]}</span>
        </div>
    REPORT;
}