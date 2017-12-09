<?php

namespace app\bg;

use \lib\app\instance\bg as bg;

class test extends bg
{
    function __construct()
    {
        $this->name = __CLASS__;
    }

    public function fire()
    {
        echo 'fire';
    }
}