<?php

namespace lib;

class debug
{
    public static function enable(bool $state)
    {
        $de = ($state) ? 1 : 0;
        $ea = ($state) ? E_ALL : 0;

        ini_set('display_errors', $de);
        ini_set('display_startup_errors', $de);
        error_reporting($ea);
    }

    public static function d($in)
    {
        var_dump($in);
    }

    public static function p($in)
    {
        print_r($in);
    }
}
