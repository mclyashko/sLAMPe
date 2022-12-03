<?php

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
    <form name="form" method="post" action="/admin/weather_gui.php">
        <span>День:</span>
        <select name="day">
            <?php
            require_once 'core/Const.php';
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
            require_once 'core/Const.php';
            foreach (dayAbouts as $about) {
                echo <<<DAY_OPTION
                <option>{$about}</option>
            DAY_OPTION;
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Подтвердить">
    </form>
</div>

<?php
phpinfo();