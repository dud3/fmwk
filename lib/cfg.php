<?php

namespace lib;

// Config manager
class cfg
{
    public static $cfg;

    public static function instance()
    {
        $cfg = new \stdClass;

        $cfg->env = '';
        $cfg->debug = false;
        $cfg->db = [
            'host' => 'localhost',
            'name' => '',
            'user' => '',
            'pass' => '',
            'port' => 3306,
            'charset' => 'utf8mb4'
        ];
        $cfg->mail = [
            'from' => 'system@domain.com'
        ];

        return $cfg;
    }

    public static function load($env = null)
    {
        if($env == null) {
            \lib\fs\fs::inc('cfg/cfg.dev.php');
        }

        \lib\fs\fs::inc('cfg/cfg.'.$env.'.php');
    }
}