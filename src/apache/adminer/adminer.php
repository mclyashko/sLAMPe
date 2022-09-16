<html lang="en">
<head>
    <title>Sorter page</title>
    <link rel="stylesheet" href="../style.css" type="text/css"/>
</head>
<body>
<?php

require_once("adminerClass.php");

$adminer = new adminerClass();

foreach ($_REQUEST as $key => $value) {
    if ($adminer->validate($value)) {
        $adminer->run($value);
    } else {
        echo "ERR";
    }
}

?>
</body>
</html>