<?php

namespace lib;

class pager
{
    private static $baseView = 'app/view/';

    public static function load($file = 'index')
    {
        if($file == null) {
            $file = 'index';
        }

        try {
            \lib\fs\fs::inc(self::$baseView.$file.'.view.php');
        }
        catch (\Exception $e)
        {
            self::_404();
            exit;
        }
    }

    public static function redirect(string $to)
    {
        $to = \lib\http\request::url()->fullhost() . "?p={$to}";
        header("Location: {$to}");
    }

    public static function _404()
    {
        \lib\fs\fs::inc(self::$baseView.'_error/404.view.php');
    }
}