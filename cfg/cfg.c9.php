<?php

lib\cfg::$cfg = lib\cfg::instance();

lib\cfg::$cfg->env = 'c9';
lib\cfg::$cfg->debug = true;
lib\cfg::$cfg->db = [
    'host' => 'localhost',
    'name' => 'c9',
    'user' => getenv('C9_USER'),
    'pass' => '',
    'port' => 3306,
    'charset' => 'utf8mb4'
];
