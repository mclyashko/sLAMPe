<?php

require_once("figureClass.php");

class circleClass extends figureClass
{
    public function __construct(int $width, int $height, string $colour)
    {
        parent::__construct(max($width, $height), max($width, $height), $colour);
    }

    public function ech(): void
    {
        echo
            "<svg
            width=" . strval($this->getWidth()) . "
            height=" . strval($this->getHeight()) . ">
            <circle 
                cx=" . strval($this->getWidth() / 2) . "
                cy=" . strval($this->getHeight() / 2) . "
                r=" . strval($this->getWidth() / 2) . "
                fill=" . strval($this->getColour()) . "
            />
        </svg>";
    }
}