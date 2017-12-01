<?php

namespace lib;

class exception
{
    private $_msg;

    public function __construct(string $msg = '')
    {
        $this->_msg = $msg;

        throw new \Exception($this->_msg);
    }

    private function beautify()
    {
    }
}