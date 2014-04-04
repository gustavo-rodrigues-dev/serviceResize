<?php
include_once "Image.php";
include_once "ImageGenerateImagick.php";
include_once "imageGenerateGD.php";
class ImageGenerate implements Image {

    private $image;
    const MODE_IMAGICK = 1;
    const MODE_GD = 2;
    public function __construct(){
        $options = func_get_args();

        if(!isset($options[1])){
            $options[1] = self::MODE_IMAGICK;
        }

        if($options[1] == self::MODE_IMAGICK && extension_loaded('imagick')){
            if(count($options)){
                $this->image = new imageGenerateImagick($options[0]);
            } else {
                $this->image = new imageGenerateImagick();
            }
        } else {
            if(count($options)){
                $this->image = new imageGenerateGD($options[0]);
            } else {
                $this->image = new imageGenerateGD();
            }
        }

    }

    private $mode;

    /**
     * @param mixed $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    /**
     * @return mixed
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param $file
     * @param string $anchor
     * @return imageGenerateGD/imageGenerateImagick
     */
    function open($file, $anchor = ''){
        $this->image->open($file, $anchor);
        return $this->image;
    }

    /**
     * @param int $width
     * @param int $height
     * @return imageGenerateGD/imageGenerateImagick
     */
    function resize($width = 160, $height = 160){
        $this->image->resize(160,160);
        return $this->image;

    }

    /**
     * @param $file
     * @param int $quality
     * @return imageGenerateGD/imageGenerateImagick
     */
    function save($file, $quality = 80){
        $this->image->save($file,$quality);
        return $this->image;
    }
}