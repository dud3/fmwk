<?php

namespace lib\http\parser;

class token
{
    public $type;
    public $literal;
    public $cat;

    public function __construct($type, $literal = null, $cat = null, $htmlInput = null)
    {
        $this->type = $type;
        $this->literal = $literal;
        $this->cat = $cat;
        $this->htmlInput = $htmlInput;
    }
}
