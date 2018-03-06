<?php

require_once "lib/_preboot.php";

// Pre-Bootstrap

lib\sys\version::check();

// Load config

lib\cfg::load('c9');

// Debug mode

lib\debug::enable(lib\cfg::$cfg->debug);

// Bootstrap

require_once "lib/_boot.php";

// Ctrl

lib\ctrl::load(
    lib\http\request::get()->getvk('p')
);
