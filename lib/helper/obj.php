<?php

namespace lib\helper;

use \lib\sys\typech as typech;

class obj
{
    private $_obj;

    public function __construct()
    {
        $this->_obj = new stdClass;

        return $this;
    }

    public function uset(string $key)
    {
        if($key != null) {
            unset($this->_obj->$key);
        }
    }

    public function set(array $arr)
    {
        foreach($arr as $k => $v) {
            $this->_obj->$k = $v;
        }
    }

    public function get()
    {
        return $this->_obj;
    }
}
