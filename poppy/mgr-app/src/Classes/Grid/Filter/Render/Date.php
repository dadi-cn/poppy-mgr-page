<?php

namespace Poppy\MgrApp\Classes\Grid\Filter\Render;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class Date extends AbstractFilterItem
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

        $start = Carbon::createFromFormat('Y-m-d', $this->value)->startOfDay()->toDateTimeString();
        $end   = Carbon::createFromFormat('Y-m-d', $this->value)->endOfDay()->toDateTimeString();

        return $this->buildCondition([
            [$this->column, '<=', trim($end)],
            [$this->column, '>=', trim($start)],
        ]);
    }
}
