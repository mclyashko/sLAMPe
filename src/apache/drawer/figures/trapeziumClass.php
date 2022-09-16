<?php

require_once("figureClass.php");

class trapeziumClass extends figureClass
{
    public function __construct(int $width, int $height, string $colour)
    {
        parent::__construct($width, $height, $colour);
    }

    public function ech(): void
    {
        echo
            "<svg
            width=" . strval($this->getWidth()) . "
            height=" . strval($this->getHeight()) . ">
            <polyline 
                points= '0, 0, 0, " . strval($this->getHeight()) . ", " . strval($this->getWidth()) . ", " . strval($this->getHeight() / 2) . ", " . strval($this->getWidth()) . ", 0" . "' 
                fill=" . strval($this->getColour()) . "
            />
        </svg>";
    }

}