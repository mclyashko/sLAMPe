<?php

namespace model;

use mysqli;

class AdminModel
{
    static private ?AdminModel $state = null;

    private mysqli $mysqli;

    private function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public static function getState($mysqli): ?AdminModel
    {
        if (AdminModel::$state == null) {
            AdminModel::$state = new AdminModel($mysqli);
        }

        return AdminModel::$state;
    }

    public function getAll(): array
    {
        $q = "SELECT * FROM " . tableUserName;

        $users = $this->mysqli->query($q);

        $result = array();
        foreach ($users as $user) {
            $result[] = $user;
        }

        $this->mysqli->close();
        return $result;
    }
}