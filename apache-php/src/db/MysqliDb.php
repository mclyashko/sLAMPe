<?php

namespace db;

class MysqliDb {

    // Данные базы данных
    private string $host = 'mysql';
    private string $db_name = 'appDB';
    private string $username = 'user';
    private string $password = 'password';
    private ?mysqli $connection = null;

    public function getConnection(): mysqli
    {
        if ($this->connection == null) {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        }

        return $this->connection;
    }

    function __destruct() {
        $this->connection->close();
    }
}