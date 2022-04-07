<?php

namespace App\Controllers;


class FontImage extends BaseController
{

    public function index()
    {
        $font = isset($_REQUEST['font']) ? $_REQUEST['font'] : '';
        $text = isset($_REQUEST['text']) ? $_REQUEST['text'] : 'Sample Text';
        $image = imagecreatetruecolor(200, 30);

        imageantialias($image, true);

        

        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        $almostblack = imagecolorallocate($image,254,254,254); 
        imagefill($image,0,0,$almostblack);
        imagecolortransparent($image,$almostblack);
        $textcolors = [$black];

        $fonts = dirname(__FILE__).'/../../assets/fonts/'.$font;
        imagettftext($image, 14, 0, 10, 20, $black, $fonts, $text);
        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);

    }
}
