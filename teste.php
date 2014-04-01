<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 3/31/14
 * Time: 9:42 PM
 */

include_once "class/ImageGenerateImagick.php";

$teste = new imageGenerateImagick();
$teste->open('image/origin/DarthVader.jpg')
        ->resize(160,160,'')
        ->save('image/destination/DarthVader.jpg');