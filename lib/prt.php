<?php

namespace lib;

class prt
{
    private static $colors = [
        'black' => '30',
        'blue' => '34',
        'green' => '32',
        'cyan' => '36',
        'red' => '31',
        'purple' => '35',
        'brown' => '33',
        'light Gray' => '37',
        'dark Gray' => '30',
        'light blue' => '34',
        'light Green' => '32',
        'light Cyan' => '36',
        'light Red' => '31',
        'light Purple' => '35',
        'yellow' => '33',
        'white' => '37'
    ];

    public static function cool(string $color, string $str)
    {
        echo "\033[" . self::$colors[$color] . 'm' . $str . "\n";
        echo "\033[" . self::$colors['white']. "m";
    }
}
