<?php

class fakeCatData
{
    public string $name;
    public string $color;
    public string $longitude;
    public string $latitude;
    public string $job;
    public string $mail;
    public string $description;

    /**
     * @param string $name
     * @param string $color
     * @param string $longitude
     * @param string $latitude
     * @param string $job
     * @param string $mail
     * @param string $description
     */
    public function __construct(
        string $name, string $color, string $longitude,
        string $latitude, string $job, string $mail,
        string $description)
    {
        $this->name = $name;
        $this->color = $color;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->job = $job;
        $this->mail = $mail;
        $this->description = $description;
    }
}