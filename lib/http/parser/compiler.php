<?php

namespace lib\http\parser;

use stdClass;

use lib\http\parser\TokenType as TokenType;

class compiler
{
    private $error;
    private $str;

    public function __construct($tokens = [], $length = 0)
    {
        $this->error = new stdClass;
        $this->error->flag = false;
        $this->error->number = 0;
        $this->error->message = '';

        if($length < 5) {
            $this->setCompileError(1, 'Unorganized syntax'); return $this->error;
        }

        unset($tokens[0]);
        unset($tokens[$length - 1]);

        $length -= 2;

        $this->checkSyntax($tokens, $length);
        $this->compile($tokens, $length);
    }

    // [something>=20-02-10^level=200|exp>100]
    // query: alphanumeric -> (=,>,>=,<,<=) -> alphanumeric
    // queries: query (^,|) query (^,|) query ...
    //
    // 1, 2, 3 |m| 4, 5, 6
    //
    // 0  1  2  3  4  5  6  7  8  9  10
    // 1, 2, 3 |m| 4, 5, 6 |m| 7, 8, 9
    //
    private function checkSyntax($tokens, $length)
    {
        if($length % 2 == 0) {
            $this->setCompileError(1, 'Unorganized syntax'); return $this->error;
        }

        $i = 1;
        while($length)
        {
            if($i == $length) break;

            if($tokens[$i]->cat != $tokens[$length]->cat)
            {
                $this->setCompileError(2, "Syntax error in " . $tokens[$i]->type . " token " . $tokens[$i]->literal);
                return $this->error;
            }

            $i++; $length--;
        }
    }

    private function compile($tokens, $length)
    {
        $this->str = '';

        for($i = 1; $i <= $length; $i++)
        {
           $this->str .= ' ' . $tokens[$i]->literal . ' ';
        }

        return $this->str;
    }

    public function getCompileError()
    {
        return $this->error;
    }

    public function getCompiledStr()
    {
        return $this->str;
    }

    private function setCompileError($code = 0, $message = '')
    {
        $this->error->flag = true;
        $this->error->code = $code;
        $this->error->message = $message;
    }
}
