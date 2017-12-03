<?php

namespace lib\helper;

class arr
{
    private $_arr;

    public function __construct(array $arr = [])
    {
        $this->_arr = $arr;

        return $this;
    }

    public function first()
    {
        if(!$this->_arr->isEmpty())
        {
            return $this->_arr[0];
        }

        return null;
    }

    public function getLast()
    {
        if(!$this->_arr->isEmpty())
        {
            return $this->_arr[$this->_arr->len() - 1];
        }

        return null;
    }

    public function isLast($key)
    {
        if(!$this->_arr->isEmpty())
        {
            return ($this->getLast() == $this->_arr[$key]);
        }

        return false;
    }

    public function len()
    {
        return count($this->_arr);
    }

    public function isThere($key)
    {
        return isset($this->_arr[$key]);
    }

    public function isEmpty()
    {
        return ($this->len() == 0);
    }

    public function insert($elem)
    {
        $this->_arr[] = $elem;
    }

    public function checkKey($key)
    {
        foreach($this->_arr as $k => $v) {
            if($key == $k) {
                return true;
            }
        }

        return false;
    }

    public function checkVal($val)
    {
        foreach($this->_arr as $k => $v) {
            if($val == $v) {
                return true;
            }
        }

        return false;
    }

    // Get value by key
    public function getvk($key)
    {
        if($this->checkKey($key)) {
            return $this->_arr[$key];
        }

        return null;
    }

    public function get()
    {
        return $this->_arr;
    }

    public function changeElem($key, $val)
    {
        $this->_arr[$key] = $val;
    }
    
    public function replace(array $arr = [])
    {
        foreach($arr as $k => $v) {
            $this->changeElem($k, $v);
        }
    }
    
    public function set(array $arr)
    {
        $this->_arr = $arr;
    }
}
