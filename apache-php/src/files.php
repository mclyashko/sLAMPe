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

<form method="post" enctype="multipart/form-data" action="files_util.php">
    Выберите файл для загрузки
    <input type="file" name="file"/><br/>
    <input type="submit" name="submit" value="Загрузить"/>
</form>

<form method="get" action="files_util.php">
    <input type="submit" name="button" value="Скачать" />
</form>

</body>
</html>