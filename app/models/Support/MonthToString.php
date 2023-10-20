<?php

namespace Support;

class MonthToString
{

    public static function index($str)
    {

        switch ($str) {

            case 1:
                return 'Нэг';
            case 2:
                return 'Хоёр';
            case 3:
                return 'Гурав';
            case 4:
                return 'Дөрөв';
            case 5:
                return 'Тав';
            case 6:
                return 'Зургаа';
            case 7:
                return 'Долоо';
            case 8:
                return 'Найм';
            case 9:
                return 'Ес';
            case 10:
                return 'Арав';
            case 11:
                return 'Арван нэг';
            case 12:
                return 'Арван хоёр';
            default:
                return $str;


        }

    }

}