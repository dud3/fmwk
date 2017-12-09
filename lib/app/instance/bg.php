<?php

namespace lib\app\instance;

// Background jobs
class bg
{
    protected $name;

    public function fire()
    {
    }

    public function getName()
    {
        return $this->name;
    }
}