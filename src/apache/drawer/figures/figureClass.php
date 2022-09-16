<?php

class figureClass
{
    private $width;
    private $height;
    private $colour;

    public function __construct(int $width, int $height, string $colour)
    {
        $this->width = $width;
        $this->height = $height;
        $this->colour = $colour;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function getColour(): string
    {
        return $this->colour;
    }

    public function setColour(string $colour): void
    {
        $this->colour = $colour;
    }

    public function ech(): void
    {
        echo "figure\n";
    }

}