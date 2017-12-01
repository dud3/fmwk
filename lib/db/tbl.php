<?php

namespace lib\db;

use \lib\helper\arr as arr;
use \lib\helper\str as str;

use \lib\db\db as db;

class tbl
{
    public static function load($tbl)
    {
        return new db($tbl);
    }
}
