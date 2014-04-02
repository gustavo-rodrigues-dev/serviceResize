<?php
include_once "Image.php";

/**
 * Class imageGenerateGD
 */
class imageGenerateGD implements  Image{
    private $image;

    /**
     * @param $file
     * @param string $anchor
     * @return $this
     */
    function open($file, $anchor = ''){
        $imagePath = $anchor.$file;
        switch (pathinfo($imagePath)) {
            case 'jpg':
            case 'jpeg':
            case 'pjpeg':
                $this->image = imagecreatefromjpeg($imagePath);
                break;
            case 'gif':
                $this->image = imagecreatefromgif($imagePath);
                break;
            case 'png':
            default:
                $this->image = imagecreatefrompng($imagePath);
        }
        imagealphablending($this->image, true);
        imagesavealpha($this->image, true);
        imagecolorallocate($this->image, 0, 0, 0);

        return $this;
    }

    /**
     * @param $width
     * @param $height
     */
    function resize($width, $height){


        // load an image
        // get the current image dimensions
        $geo = array(
            'width'     =>  imagesx($this->image),
            'height'    =>  imagesy($this->image)
        );

        // crop the image
        if(($geo['width']/$width) < ($geo['height']/$height)){
            $ratio = $width / $geo['height'];
            $newheight = $height;
            $newwidth = $width * $ratio;
            $writex = round(($width - $newwidth) / 2);
            $writey = 0;
            $newimg = imagecreatetruecolor($geo['width'],floor($height*$geo['width']/$width));
            //$this->image->cropImage($geo['width'], floor($height*$geo['width']/$width), 0, (($geo['height']-($height*$geo['width']/$width))/2));
            //imagecopyresampled($resize->source, $this->source, $thumb_X, $thumb_Y, 0, 0, $thumb_W, $thumb_H, $orig_W, $orig_H);
        } else {
            $ratio = $width / $geo['width'];
            $newwidth = $width;
            $newheight = $geo['height'] * $ratio;
            $writex = 0;
            $writey = round(($geo['height'] - $newheight) / 2);
            $newimg = imagecreatetruecolor(ceil($width*$geo['height']/$height),$geo['height']);
            //$this->image->cropImage(ceil($width*$geo['height']/$height), $geo['height'], (($geo['width']-($width*$geo['height']/$height))/2), 0);
        }
        imagecolorallocate($newimg,0,0,0);
        imagecopyresized($newimg, $this->image, $writex, $writey, 0, 0, $newwidth, $newheight, $width, $height);
        $this->image = $newimg;
        return $this;
    }

    /**
     * @param $file
     * @param $quality
     */
    function save($file, $quality){
        imagejpeg($this->image,$file, intval($quality));
    }
}