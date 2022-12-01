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

phpinfo();