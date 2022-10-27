<?php

class Admin_user
{
    // Подключение к БД
    private mysqli $connection;

    // Свойства
    public int $ID;
    public string $login;
    public string $password;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    function read(): bool|mysqli_result
    {
        $query = "
            SELECT u.id, u.login, u.password FROM users AS u
            ORDER BY u.id; 
        ";

        return $this->connection->query($query);
    }

    function create(): bool
    {
        $query = "
            INSERT INTO users
            SET
                login=:login, password=:password;
        ";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }

    function readOne(): mysqli_result|bool
    {
        $query = "
        SELECT
            u.id, u.login, u.password
        FROM
            users AS u
        WHERE
            u.id = :id;
        ";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }

    function update(): bool
    {
        $query = "
        UPDATE
            users
        SET
            login = :login,
            password = :password
        WHERE
            id = :id;
        ";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }

    function delete(): bool
    {
        $query = "DELETE FROM users WHERE id = :id;";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }
}