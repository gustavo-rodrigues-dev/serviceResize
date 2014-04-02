<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 3/31/14
 * Time: 9:42 PM
 */

include_once "class/ImageGenerate.php";

$teste = new imageGenerate('image/origin/DarthVader.jpg');
$teste->resize(160,160)
        ->save('image/destination/DarthVader.jpg');