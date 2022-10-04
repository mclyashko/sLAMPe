<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather Report</title>
</head>
<body>
<h1>Админ-панель</h1>
<p>Обновить значение:</p>

<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <span>День:</span>
    <select name="day">
        <?php
        require_once '../const.php';
        foreach (days as $day) {
            echo <<<DAY_OPTION
                <option>{$day}</option>
            DAY_OPTION;
        }
        ?>
    </select>
    <span>Температура:</span>
    <input type="number" name="temp" value="20"/>
    <span>Ощущения:</span>
    <select name="about">
        <?php
        require_once '../const.php';
        foreach (dayAbouts as $about) {
            echo <<<DAY_OPTION
                <option>{$about}</option>
            DAY_OPTION;
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Подтвердить">
</form>

<?php
require_once '../const.php';

$submitBtnName = 'submit';

if (isset($_POST[$submitBtnName])) {
    $mysqli = new mysqli(dbHost, dbUser, dbPass, dbName);

    $q = "UPDATE " . tableWeatherReportName .
        " SET " . tableWeatherReportTemperature . " = " . $_POST['temp'] . ", " .
        tableWeatherReportAbout . " = '" . $_POST['about'] . "'" .
        " WHERE " . tableWeatherReportDay . " = '" . $_POST['day'] . "'";

    $mysqli->query($q);

    $mysqli->close();

    echo "Проверьте внесенные изменения";
} else {
    echo "Внесите изменения";
}

?>
<div>
    <a href="../index.html">Главная</a>
</div>
</body>
</html>