<?php

namespace lib\http;

class url
{
    private $_url;

    public function __construct(string $url)
    {
        $this->_url = parse_url($url);
    }

    public function get()
    {
        return $this->_url;
    }

    public function scheme()
    {
        return $this->_url['scheme'];
    }

    public function host()
    {
        return $this->_url['host'];
    }

    public function fullhost()
    {
        return $this->scheme() . '://' . $this->host();
    }

    public function path()
    {
        return $this->_url['path'];
    }

    public function query()
    {
        return $this->_url['query'];
    }
}
