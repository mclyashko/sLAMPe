<?php
require_once '../const.php';

echo <<< NAVIGATION
    <div>
        <a href="../index.html">Главная</a>
    </div>
NAVIGATION;

if (isset($_SESSION[session_login])) {
    echo "Ваш сессионный логин установлен в значение: " . $_SESSION[session_login];
}

phpinfo();