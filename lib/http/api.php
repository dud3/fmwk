<?php

namespace lib\http;

use \lib\http\request as request;

class api
{
    public static function find()
    {
        // post and get

        if(request::type('isGet')) {
            // parse arguments...
        }

        if(request::type('isPost')) {
            // the data structure should be:
            // {
            //  q: (table\condition\relTable1,reltable2...)
            // }

            // E.x.1: user\id>2&star>=4|rate>=8\profile,stats
            // E.x.2: user\id>2&star>=4|rate>=8&_take=10&_skip=2&sort=id&order=asc\profile,stats
            // conditions only apply to user table

            // start splitting by `\`, let differnt parts of the parser handle different branches
        }
    }

    public static function create()
    {
        // post

        if(request::type('isPost')) {
            // the data structure should be:
            // {
            //  key: value
            // }
        }
    }

    public static function edit()
    {
        // post

        if(request::type('isPost')) {
            // combine find and create arguments
            // {
            //  q: (table\condition\relTable1,reltable2...)
            //  d: { key: value }
            // }
        }
    }

    public static function remove()
    {
        // post

        if(request::type('isPost')) {
            // use find to find the entries and then remove
            // {
            //  q: (table\condition)
            // }
        }
    }
}