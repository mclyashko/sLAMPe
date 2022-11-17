<?php

function resize_image($image, $w, $h): GdImage|bool
{
    $oldw = imagesx($image);
    $oldh = imagesy($image);
    $temp = imagecreatetruecolor($w, $h);
    imagecopyresampled($temp, $image, 0, 0, 0, 0, $w, $h, $oldw, $oldh);
    return $temp;
}

function add_watermark(string $to_add, string $watermark): void
{
    $stamp = imagecreatefrompng($watermark);
    $im = imagecreatefrompng($to_add);

    $stamp = resize_image($stamp, 128, 87);
    imagealphablending($stamp, false);
    imagesavealpha($stamp, true);
    imagefilter($stamp, IMG_FILTER_COLORIZE, 0,0,0,127*0.5);

    $marge_right = 100;
    $marge_bottom = 100;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

    imagepng($im, $to_add);
    imagedestroy($im);
    imagedestroy($stamp);
}