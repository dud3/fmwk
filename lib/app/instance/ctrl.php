<?php

namespace lib\app\instance;

class ctrl
{
    protected $filters = [];

    protected function loadData(array $table)
    {
    }

    public function getFilters()
    {
        return $this->filters;
    }
}
