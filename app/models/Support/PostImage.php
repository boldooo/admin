<?php

namespace Support;


class PostImage
{

    public static function _src($key_path, $filename)
    {

        if ($filename != '' && file_exists(public_path('backend/image/' . $key_path . '/' . $filename)))

            return '/backend/image/' . $key_path . '/' . $filename;

        else

            return '/front/images/no-image.jpg';

    }

    public static function _alt($key_path, $filename)
    {

        if ($filename != '' && file_exists(public_path('backend/image/' . $key_path . '/' . $filename)))

            return $filename;

        else

            return 'Зураг сонгоогүй';

    }

    public static function back_checker($key_path, $json_pic)
    {

        if ($json_pic == '')

            return false;

        $array_pic = json_decode($json_pic);

        $filename = $array_pic[1]->picture;

        if ($filename != '' && file_exists(public_path('backend/image/' . $key_path . '/' . $filename)))

            return true;

        else

            return false;

    }

    public static function front_checker($key_path, $json_pic)
    {

        if ($json_pic == '')

            return false;

        $array_pic = json_decode($json_pic);

        $filename = $array_pic[0]->picture;

        if ($filename != '' && file_exists(public_path('backend/image/' . $key_path . '/' . $filename)))

            return true;

        else

            return false;

    }

}