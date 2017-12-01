<?php

lib\cfg::$cfg = lib\cfg::instance();

lib\cfg::$cfg->env = 'pro';
lib\cfg::$cfg->debug = false;
lib\cfg::$cfg->db = [
    'name' => '',
    'user' => '',
    'pass' => '',
    'port' => 3306,
    'charset' => 'utf8mb4'
];
