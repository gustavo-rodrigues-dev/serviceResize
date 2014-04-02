<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 3/31/14
 * Time: 9:42 PM
 */

include_once "class/imageGenerateGD.php";

$teste = new imageGenerateGD('image/origin/DarthVader.jpg');
$teste->resize(160,160,'')
        ->save('image/destination/DarthVader.jpg');