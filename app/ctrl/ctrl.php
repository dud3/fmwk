<?php

namespace app\ctrl;

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
