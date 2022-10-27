<?php

class Forecast
{
    // Подключение к БД
    private mysqli $connection;

    // Свойства
    public int $id;
    public string $day;
    public int $temperature;
    public string $about;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    function read(): bool|mysqli_result
    {
        $query = "
            SELECT w.id, w.day, w.temperature, w.about FROM weather_report AS w
            ORDER BY w.id; 
        ";

        return $this->connection->query($query);
    }

    function create(): bool
    {
        $query = "
            INSERT INTO weather_report (day, temperature, about)
            VALUES 
                ('" . $this->day . "', '" . $this->temperature . "', '" . $this->about . "');
        ";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }

    function readOne(): mysqli_result|bool
    {
        $query = "
        SELECT
            w.id, w.day, w.temperature, w.about
        FROM
            weather_report AS w
        WHERE
            w.id = " . $this->id . ";
        ";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }

    function update(): bool
    {
        $query = "
        UPDATE
            weather_report AS w
        SET
            w.day = '" . $this->day . "',
            w.temperature = '" . $this->temperature . "',
            w.about = '" . $this->about . "'
        WHERE
            w.id = '" . $this->id . "'
        ";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }

    function delete(): bool
    {
        $query = "DELETE FROM weather_report WHERE id = '" . $this->id . "';";

        $result = $this->connection->query($query);
        $this->connection->commit();

        return $result;
    }
}