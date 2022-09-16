<?php

require_once("figures/circleClass.php");
require_once("figures/rectangleClass.php");
require_once("figures/triangleClass.php");
require_once("figures/trapeziumClass.php");

class drawerClass
{
    const figures = array(
        0b00 => circleClass::class,
        0b01 => rectangleClass::class,
        0b10 => triangleClass::class,
        0b11 => trapeziumClass::class
    );
    const figureMask = 0b11;
    const figureBlockSize = 2;
    const figureMaskLen = 2;

    const colours = array(
        0b00 => "red",
        0b01 => "green",
        0b10 => "blue",
        0b11 => "black"
    );
    const colourMask = 0b1100;
    const colourBlockSize = 2;
    const colourMaskLen = self::figureMaskLen + self::colourBlockSize;

    const widthMask = 0b1110000;
    const widthBlockSize = 3;
    const widthMaskLen = self::colourMaskLen + self::widthBlockSize;

    const heightMask = 0b1110000000;
    const heightBlockSize = 3;
    const heightMaskLen = self::widthMaskLen + self::heightBlockSize;

    const encodedBitsSize = 10;
    const minEncoded = 0;
    const maxEncoded = 2 << self::encodedBitsSize;

    const scaleVal = 10;

    public function validate($val): bool
    {
        return preg_match('/^\d+$/', $val) && $val >= self::minEncoded && $val <= self::maxEncoded;
    }

    public function addFigure($value): void
    {
        $fig = $this->genFigure($value);
        $fig->ech();
    }

    private function genFigure($value): figureClass
    {
        $type = $this->decodeFigureType($value);

        $colour = $this->decodeFigureColour($value);
        $width = $this->scale($this->decodeFigureWidth($value));
        $height = $this->scale($this->decodeFigureHeight($value));

        return new $type($width, $height, $colour);
    }

    private function scale($valToScale): int
    {
        return $valToScale * self::scaleVal;
    }

    private function decodeFigureType($value): string
    {
        return self::figures[$this->getBits($value, self::figureMask, self::figureMaskLen, self::figureBlockSize)];
    }

    private function decodeFigureColour($value): string
    {
        return self::colours[$this->getBits($value, self::colourMask, self::colourMaskLen, self::colourBlockSize)];
    }

    private function decodeFigureWidth($value): int
    {
        return $this->getBits($value, self::widthMask, self::widthMaskLen, self::widthBlockSize);
    }

    private function decodeFigureHeight($value): int
    {
        return $this->getBits($value, self::heightMask, self::heightMaskLen, self::widthBlockSize);
    }

    private function getBits($from, $mask, $maskLen, $blockSize): int
    {
        return (($from & $mask) << (self::encodedBitsSize - $maskLen)) >> (self::encodedBitsSize - $blockSize);
    }
}

