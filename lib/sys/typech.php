<?php

namespace lib\sys;

class typech
{
    public static function check($data, $type = '')
    {
        $eflag = false;

        if($type == '') {
             throw new \lib\exception("Type can't be an empty string");
        }

        switch($type) {
            case 'string':
                    if(!is_string($data)) $eflag = true;
                break;

            case 'integer':
                    if(!is_integer($data)) $eflag = true;
                break;

            case 'bool':
                    if(!is_bool($data)) $eflag = true;
                break;

            case 'array':
                    if(!is_array($data)) $eflag = true;
                break;

            case 'std':
                    // ...
                break;
        }

        if($eflag) {
            throw new \lib\exception("Type and the data doesn't match.");
        }

    }
}