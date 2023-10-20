<?php

namespace Support;

class Link
{

    public static function generate($url, $param)
    {

        if (strpos($url, '?') !== false) {

            return $url . '&' . $param;

        } else if ($url == '') {

            return '/menu_group?' . $param;

        } else {

            return $url . '?' . $param;

        }

    }

}