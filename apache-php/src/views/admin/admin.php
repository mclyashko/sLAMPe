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

<?php

const tableUserName = 'users';
const tableUserId = 'ID', tableUserLogin = 'login', tableUserPassword = 'password';
const days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
const dayAbouts = array('good', 'normal', 'bad');

foreach ($users as $user) {
    echo <<<USER_INFO
        <div>
            <span>{$user[tableUserId]}</span>
            <span>{$user[tableUserLogin]}</span>
            <span>{$user[tableUserPassword]}</span>
        </div>
    USER_INFO;
}

?>

    <div>
        <form name="form" method="post" action="update">
            <span>День:</span>
            <select name="day">
                <?php
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
                foreach (dayAbouts as $about) {
                    echo <<<DAY_OPTION
                <option>{$about}</option>
            DAY_OPTION;
                }
                ?>
            </select>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <input type="submit" name="submit" value="Подтвердить">
        </form>
    </div>

<?php
function embedded_phpinfo()
{
    ob_start();
    phpinfo();
    $phpinfo = ob_get_contents();
    ob_end_clean();
    $phpinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $phpinfo);
    echo "
        <style type='text/css'>
            #phpinfo {}
            #phpinfo pre {margin: 0; font-family: monospace;}
            #phpinfo a:link {color: #009; text-decoration: none; background-color: #fff;}
            #phpinfo a:hover {text-decoration: underline;}
            #phpinfo table {border-collapse: collapse; border: 0; width: 934px; box-shadow: 1px 2px 3px #ccc;}
            #phpinfo .center {text-align: center;}
            #phpinfo .center table {margin: 1em auto; text-align: left;}
            #phpinfo .center th {text-align: center !important;}
            #phpinfo td, th {border: 1px solid #666; font-size: 75%; vertical-align: baseline; padding: 4px 5px;}
            #phpinfo h1 {font-size: 150%;}
            #phpinfo h2 {font-size: 125%;}
            #phpinfo .p {text-align: left;}
            #phpinfo .e {background-color: #ccf; width: 300px; font-weight: bold;}
            #phpinfo .h {background-color: #99c; font-weight: bold;}
            #phpinfo .v {background-color: #ddd; max-width: 300px; overflow-x: auto; word-wrap: break-word;}
            #phpinfo .v i {color: #999;}
            #phpinfo img {float: right; border: 0;}
            #phpinfo hr {width: 934px; background-color: #ccc; border: 0; height: 1px;}
        </style>
        <div id='phpinfo'>
            $phpinfo
        </div>
        ";
}
embedded_phpinfo();
?>