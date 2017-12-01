<?php

lib\cfg::$cfg = lib\cfg::instance();

lib\cfg::$cfg->env = 'dev';
lib\cfg::$cfg->debug = true;
lib\cfg::$cfg->db = [
    'name' => '',
    'user' => '',
    'pass' => '',
    'port' => 3306,
    'charset' => 'utf8mb4'
];
