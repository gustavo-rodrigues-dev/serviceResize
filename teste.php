<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 3/31/14
 * Time: 9:42 PM
 */

include_once "class/ImageGenerateImagick.php";
/*
$teste = new imageGenerateImagick('image/origin/DarthVader.jpg');
$teste->resize(160,160,'')
        ->save('image/destination/DarthVader.jpg');*/

$path_parts = pathinfo('image/origin/DarthVader.jpg');
$colorVal = hexdec('ffffff');
$color_R = 0xFF & ($colorVal >> 0x10);
$color_G = 0xFF & ($colorVal >> 0x8);
$color_B = 0xFF & $colorVal;


var_dump($colorVal);