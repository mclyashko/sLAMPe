<html lang="en">
<head>
    <title>Drawer page</title>
    <link rel="stylesheet" href="../style.css" type="text/css"/>
</head>
<body>
<?php

require_once("drawerClass.php");

$drawer = new drawerClass();

foreach ($_REQUEST as $key => $value) {
    if ($drawer->validate($value)) {
        $drawer->addFigure($value);
    } else {
        echo "ERR";
    }
}

?>
</body>
</html>