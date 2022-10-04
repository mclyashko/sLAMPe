<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather Report</title>
</head>
<body>
<h1>Пользователи</h1>
<p>Список:</p>

<?php
require_once '../const.php';

$mysqli = new mysqli(dbHost, dbUser, dbPass, dbName);

$q = "SELECT * FROM " . tableUserName;

$users = $mysqli->query($q);

foreach ($users as $user) {
    echo <<<USER_INFO
        <div>
            <span>{$user[tableUserId]}</span>
            <span>{$user[tableUserLogin]}</span>
            <span>{$user[tableUserPassword]}</span>
        </div>
    USER_INFO;
}

$mysqli->close();
?>
<div>
    <a href="../index.html">Главная</a>
    <a href="../admin/admin.php">Админ-панель</a>
</div>
</body>
</html>
