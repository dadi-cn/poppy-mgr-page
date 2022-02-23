<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class Month extends AbstractFilterItem
{
    /**
     * Get condition of this filter.
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function condition(array $inputs)
    {
        if (!Arr::has($inputs, $this->column)) {
            return null;
        }

        $this->value = Arr::get($inputs, $this->column);

        if (!$this->value) {
            return null;
        }

        $start = Carbon::createFromFormat('Y-m', $this->value)->startOfMonth()->toDateTimeString();
        $end   = Carbon::createFromFormat('Y-m', $this->value)->endOfMonth()->toDateTimeString();

        return $this->buildCondition([
            [$this->column, '<=', trim($end)],
            [$this->column, '>=', trim($start)],
        ]);
    }
}
