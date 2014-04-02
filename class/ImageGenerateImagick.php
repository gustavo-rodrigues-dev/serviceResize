<?php
include_once "Image.php";

/**
 * Class imageGenerateImagick
 */
class imageGenerateImagick implements  Image{
    private $image;

    public function __construct(){
        $options = func_get_args();
        if(count($options)){
            $this->image = new Imagick($options[0]);
        } else {
            $this->image = new Imagick();
        }

    }

    /**
     * @param $file
     * @param $anchor
     * @return imageGenerateImagick
     */
    function open($file, $anchor = ''){
        $this->image->readImage($file);
        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return imageGenerateImagick
     */
    function resize($width = 160, $height = 90){

        // load an image
        // get the current image dimensions
        $geo = $this->image->getImageGeometry();

        // crop the image
        if(($geo['width']/$width) < ($geo['height']/$height)){
            $this->image->cropImage($geo['width'], floor($height*$geo['width']/$width), 0, (($geo['height']-($height*$geo['width']/$width))/2));
        } else {
            $this->image->cropImage(ceil($width*$geo['height']/$height), $geo['height'], (($geo['width']-($width*$geo['height']/$height))/2), 0);
        }
        // thumbnail the image
        $this->image->ThumbnailImage($width,$height,true);
        return $this;

    }

    /**
     * @param $file
     * @param int $quality
     * @return imageGenerateImagick
     */
    function save($file, $quality = 80){
        $this->image->setImageCompression(Imagick::COMPRESSION_JPEG);
        $this->image->setImageCompressionQuality(intval($quality));
        $this->image->writeImage( $file );
        $this->image->clear();
        $this->image->destroy();
        return $this;
    }

}