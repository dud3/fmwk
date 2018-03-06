<?php

namespace lib;

class debug
{
    public static function enable(bool $state)
    {
        $de = ($state) ? 'On' : 0;
        $ea = ($state) ? E_ALL : 0;

        error_reporting($ea);
        ini_set('display_errors', $de);
        ini_set('display_startup_errors', $de);
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
