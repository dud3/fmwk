<?php

namespace app\bg;

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