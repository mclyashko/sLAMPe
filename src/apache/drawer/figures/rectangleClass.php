<?php

require_once("figureClass.php");

class rectangleClass extends figureClass
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
            <rect 
                width=".strval($this->getWidth())." 
                height=".strval($this->getHeight())." 
                fill=".strval($this->getColour())."
            />        
        </svg>";
    }
}