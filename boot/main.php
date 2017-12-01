<?php

require_once "lib/_deps.php";

// Bootstrap

lib\sys\version::check();

// Load config

lib\cfg::load('c9');

// Debug mode

lib\debug::enable(lib\cfg::$cfg->debug);

// Ctrl

lib\ctrl::load(
    lib\http\request::get()->getvk('p')
);
