<?php

namespace app\ctrl;

\lib\sys\module::inc('app/ctrl/ctrl');

class index extends ctrl
{
    public function __construct()
    {
        $this->filters = [];
    }
}
