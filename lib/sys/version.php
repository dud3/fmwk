<?php

namespace lib\sys;

class version
{
    private static $_php7 = '7.0.0';

    public static function check()
    {
        if(!self::is7()) {
            exit("Sorry, fmwk does not run on a PHP version older than" . self::$_php7 . ".");
        }
    }

    public static function is7()
    {
        if (version_compare(PHP_VERSION, self::$_php7, '>=')) {
            return true;
        }

        return false;
    }

    public static function isLess()
    {
        return self::is7();
    }
}