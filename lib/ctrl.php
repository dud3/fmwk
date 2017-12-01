<?php

namespace lib;

class ctrl
{
    public static function load($file = 'index')
    {
        if($file == null) {
            $file = 'index';
        }

        $ctrlbase = 'app/ctrl/';
        $filterbase = 'app/filters/';

        try {
            \lib\fs\fs::inc($ctrlbase.$file.'.php');

            // Ctrl

            $cfile = '\app\ctrl\\'.$file;
            $cfile = new $cfile;

            // Filters

            $filters = $cfile->getFilters();

            foreach($filters as $filter) {
                \lib\fs\fs::inc($filterbase.$filter.'.php');

                $filter = '\app\filters\\'.$filter;
                $cfilter = new $filter;
                $cfilter->fire();
            }

            // Data
            //

            // Pager

            \lib\pager::load($file);
        }
        catch (\Exception $e)
        {
            \lib\pager::_404();
            // new \lib\exception($e->getMessage());
        }
    }
}