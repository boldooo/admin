<?php

class Captcha extends BaseController
{

    public function index()
    {
        $chars = '0123456789';
        $randomString = '';

        for ($i = 0; $i < 5; $i++) {
            $randomString .= $chars[rand(0, strlen($chars) - 1)];
        }

        Session::put('super-assist', strtolower($randomString));

        $im = imagecreatefrompng(public_path() . "/front/img/captcha_bg.png");

        imagettftext($im, 25, 0, 5, 45, imagecolorallocate($im, 0, 0, 0), public_path('front/css/fonts/larabie/larabiefont.ttf'), $randomString);

        header('Content-type: image/png');
        imagepng($im, NULL, 0);
        imagedestroy($im);
    }

}