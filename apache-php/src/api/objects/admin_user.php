<?php

class Admin_user
{
    // Подключение к БД
    private mysqli $connection;

    // Свойства
    public int $id;
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
            INSERT INTO users (login, password)
            VALUES 
                ('" . $this->login . "', '" . $this->password . "');
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
            u.id = " . $this->id . ";
        ";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }

    function update(): bool
    {
        $query = "
        UPDATE
            users AS u
        SET
            u.login = '" . $this->login . "',
            u.password = '" . $this->password . "'
        WHERE
            u.id = '" . $this->id . "'
        ";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }

    function delete(): bool
    {
        $query = "DELETE FROM users WHERE id = '" . $this->id . "';";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }
}