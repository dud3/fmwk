<?php

namespace lib\sys;

class module
{
    public static function inc(string $file)
    {
        \lib\fs\fs::inc($file . '.php');
    }
}
