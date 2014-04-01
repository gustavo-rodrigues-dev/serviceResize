<?php

/**
 * Interface Image
 */
interface Image{

    /**
     * @param $file
     * @param $anchor
     */
    function open($file, $anchor);

    /**
     * @param $width
     * @param $height
     */
    function resize($width, $height);

    /**
     * @param $file
     * @param $quality
     */
    function save($file, $quality);

}

?>