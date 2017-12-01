<?php

namespace lib\http;

class request
{
    public static function all()
    {
        if(!$this->get()->isEmpty()) {
            return $this->get();
        }

        if(!$this->post()->isEmpty()) {
            return $this->post();
        }

        return \lib\helper\arr();
    }

    public static function get()
    {
        return new \lib\helper\arr($_GET);
    }

    public static function post()
    {
        return new \lib\helper\arr($_POST);
    }

    public static function type(string $type = 'isGet')
    {
        $type = new \lib\helper\str($type);

        $reqType = new \lib\helper\arr();

        if(!self::get()->isEmpty()) {
            $reqType->insert('isGet');
        }

        if(!self::post()->isEmpty()) {
            $reqType->insert('isPost');
        }

        return $reqType->isThere($type->get());
    }

    public static function url()
    {
        $http = ($_SERVER['SERVER_PORT'] == 443) ? "https" : "http";

        $f = $http . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return new \lib\http\url($f);
    }
}