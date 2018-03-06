<?php

namespace lib\fs;

use \Exception;

class fs
{
    public static function check($file = null)
    {
        if (!file_exists($file)) {
            throw new Exception ("{$file} does not exist");
        }
    }

    public static function inc($file = null, bool $exit = false)
    {
        try {
            self::check($file);
        }
        catch (Exception $e)
        {
            if($exit) exit("{$e->getMessage()}");

            throw new Exception ("{$file} does not exist");
        }

        require_once $file;
    }
}
