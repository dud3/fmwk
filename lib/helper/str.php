<?php

namespace lib\helper;

class str
{
    private $_str;

    public function __construct(string $str = '')
    {
        $this->_str = $str;

        return $this;
    }

    public function split(string $by)
    {
        return new arr(explode($by, $this->_str));
    }

    public function add(string $str)
    {
        $this->_str .= $str;

        return $this;
    }

    public function padd(string $by)
    {
        if($this->len() > 1) {
            $this->_str = $by.$this->_str.$by;
        }

        return $this;
    }

    public function isEmpty()
    {
        return isEmpty($this->_str);
    }

    public function len()
    {
        return strlen($this->_str);
    }

    public function isAlpha()
    {
        return ctype_alpha($this->_str);
    }

    public function get()
    {
        return $this->_str;
    }

    public function set(string $str)
    {
        $this->_str = $str;
    }
}