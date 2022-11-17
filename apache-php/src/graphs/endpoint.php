<?php
require_once '../const.php';
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
<h1>Графики</h1>
<?php
require_once 'fakeCatsGenerator.php';

echo json_encode(generate_cats(50));
?>
<div>
    <a href="../index.html">Главная</a>
</div>
</body>
</html>