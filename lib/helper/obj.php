<?php

namespace lib\helper;

class obj
{
    private $_obj;

    public function __construct(array $arr)
    {
        $this->_obj = new stdClass;

        $this->set($arr);

        return $this;
    }

    public function uset(string $key)
    {
        if($key != null) unset($this->_obj->$key);
    }

    public function set(array $arr)
    {
        foreach($arr as $k => $v) $this->_obj->$k = $v;
    }

    public function get()
    {
        return $this->_obj;
    }
}
