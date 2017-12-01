<?php

namespace app\bg;

\lib\fs\fs::inc('app/bg/bg.php');

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