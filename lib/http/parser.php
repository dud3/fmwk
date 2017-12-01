<?php

namespace lib\http;

use \lib\helper\obj as obj;
use \lib\helper\str as str;

class parser
{
    private static $_parse;

    private static function parseTable($string)
    {
        $string = new str($string);
    }

    private static function parseCondition($string)
    {
        $string = new str($string);
    }

    private static function parseTableRel($string)
    {
        $string = new str($string);
    }

    private static function detectTokenPart($tokenPart)
    {
        // check if tbl
        // else check if condition
        // else check if reltbl
    }

    // Sample input: (tbl\name=abd&id=2|id<=10\reltbl1,reltbl2)

    public static function parse($string = null)
    {
        self::$_parse = new obj();

        $string = new str($string);

        // valid strings
        // tbl
        // tbl\condition
        // tbl\reltbl1,reltbl2
        // tbl\condition\reltbl1,reltbl2

        // valid tbl
        // tbl

        // valid conditon
        // no condition, (key,symbol,value)

        // valid reltable
        // reltbl1 or reltbl1,reltbl2

        $tokens = $string->split('\\');

        if($tokens->isEmpty()) {
            // thow exception...
        }

        if($tokens->len() == 1) {
            // only table name

            // self::$_parse = ['tbl' => self::parseTable($tokens->getvk(0))];
        }

        if($tokens->len() == 2) {
            // table name and (condition or reltables)

            // self::$_parse = ['' => self::parseTable($tokens->getvk(0), $tokens->getvk(1))];
        }

        if($tokens->len() == 3) {
            // have to be in the following order, otherwise fail
            // table name and condition and reltables

            // self::parseTable($tokens->getvk(0), $tokens->getvk(1), $tokens->getvk(2));
        }

        // $table = self::parseTable();

        // return $_parse;
    }
}