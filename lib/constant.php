<?php

namespace lib;

class constant
{
    public static function instance()
    {
        $const = new stdClass;
        $const->dir = new stdClass;
        $const->namespace = new stdClass;

        $const->dir->app = 'app';

        $const->dir->ctrl = $const->dir->app.'/ctrl';
        $const->dir->filter = $const->dir->app.'/filter';
        $const->dir->bg = $const->dir->app.'/bg';
        $const->dir->view = $const->appBase.'/view';

        $const->namespace->ctrl = $const->dir->app.'\ctrl\\';
        $const->namespace->filter = $const->dir->app.'\filter\\';
        $const->namespace->bg = $const->dir->app.'\bg\\';
        $const->namespace->view = $const->appBase.'\view\\';

        return $const;
    }
}
