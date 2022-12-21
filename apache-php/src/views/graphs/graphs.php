<?php

require_once __DIR__ . '/../site/const.php';

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

spl_autoload_register(function ($class) { //autoload classes
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});

// сквозная функциональность сессий

function set_theme(): void
{
    if (isset($_SESSION[session_theme]) and $_SESSION[session_theme]) {
        echo <<< DARK_THEME
        <style>
            body {
                background-color: black !important;
                color: white !important;
            }
        </style>
        DARK_THEME;
    }
}

function set_enlarged_font(): void
{
    if (isset($_SESSION[session_enlarged_font]) and $_SESSION[session_enlarged_font]) {
        echo <<< ENLARGED_FONT
        <style>
            body {
                font-size: xx-large; !important;
            }
        </style>
        ENLARGED_FONT;
    }
}

if (!preg_match("/file_get.php.*/", $_SERVER['REQUEST_URI'])) {
    set_theme();
    set_enlarged_font();
}
// сквозная функциональность сессий

?>

<div>
    <img src="http://localhost/web/images/pie.png">
    <img src="http://localhost/web/images/bar.png">
    <img src="http://localhost/web/images/scatter.png">
</div>
<?php
echo json_encode($fixture);