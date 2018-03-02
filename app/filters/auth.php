<?php

namespace app\filters;

class auth extends \lib\filter
{
    public static function fire()
    {
        if(!\lib\auth::check())
        {
            \lib\pager::redirect('login');
        }
    }
}
