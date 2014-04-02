<?php
include_once "Image.php";

/**
 * Class imageGenerateGD
 */
class imageGenerateGD implements  Image{
    private $image;

    public function __construct(){
        $options = func_get_args();
        if(count($options)){
            $this->open($options[0]);
        }

    }

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
                $this->image = imagecreatefrompng($imagePath);
            default:
                $this->image = imagecreatefromjpeg($imagePath);
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

        $original_aspect = $geo['width'] / $geo['height'];
        $thumb_aspect = $width / $height;

        if ( $original_aspect >= $thumb_aspect )
        {
            // If image is wider than thumbnail (in aspect ratio sense)
            $new_height = $height;
            $new_width = $geo['width'] / ($geo['height'] / $height);
        }
        else
        {
            // If the thumbnail is wider than the image
            $new_width = $width;
            $new_height = $geo['height'] / ($geo['width'] / $width);
        }

        $thumb = imagecreatetruecolor( $width, $height );

        // Resize and crop
        imagecopyresampled($thumb,
            $this->image,
            0 - ($new_width - $width) / 2, // Center the image horizontally
            0 - ($new_height - $height) / 2, // Center the image vertically
            0, 0,
            $new_width, $new_height,
            $geo['width'], $geo['height']);
        $this->image = $thumb;
        return $this;
    }

    /**
     * @param $file
     * @param $quality
     */
    function save($file, $quality = 90){
        imagejpeg($this->image,$file, intval($quality));
    }
}