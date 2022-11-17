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
require_once 'pieGraph.php';
require_once 'barGraph.php';
require_once 'scatterGraph.php';

file_put_contents('fakeCats.json', json_encode(generate_cats(50)));

draw_pie();
draw_bar();
draw_scatter();
?>
<div>
    <img src="pie.png">
    <img src="bar.png">
    <img src="scatter.png">
</div>
<div>
    <a href="../index.html">Главная</a>
</div>
<div>
    <?php
        require_once 'dataLoader.php';

        echo json_encode(raw_data());
    ?>
</div>
</body>
</html>