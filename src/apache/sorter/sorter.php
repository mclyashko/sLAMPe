<html lang="en">
<head>
    <title>Sorter page</title>
    <link rel="stylesheet" href="../style.css" type="text/css"/>
</head>
<body>
<?php

require_once("sorterClass.php");

$sorter = new sorterClass();
$arrForSort = array();

foreach ($_REQUEST as $key => $value) {
    if ($sorter->validate($value)) {
        $sorter->sortAndEch($value);
    } else {
        echo "ERR";
    }
}

?>
</body>
</html>