<?php

if(count($_GET) > 0) {
    $df = '../app/view/_error/'  . $_GET['p'] . '.view.php';

    if(file_exists($df)) {
        require_once($df);
        exit;
    }
}

require_once('404.view.php');
