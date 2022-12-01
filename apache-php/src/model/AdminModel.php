<?php

class AdminModel {
    private mysqli $mysqli;

    public function __construct() {
        $this->mysqli = (new MysqliDb())->getConnection();
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