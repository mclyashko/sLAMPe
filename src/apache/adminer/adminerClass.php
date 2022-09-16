<?php

class adminerClass
{

    const commands = array(
        "ls" => true,
        "ps" => true,
        "whoami" => true,
        "id" => true,
        "uname" => true
    );

    public function validate($value): bool
    {
        if (self::commands[$value]) {
            return true;
        } else {
            return false;
        }
    }

    public function run($value)
    {
        echo shell_exec($value);
    }
}