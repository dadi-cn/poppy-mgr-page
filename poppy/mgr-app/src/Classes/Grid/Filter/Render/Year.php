<?php

namespace Poppy\MgrApp\Classes\Grid\Filter\Render;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class Year extends AbstractFilterItem
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

        $start = Carbon::createFromFormat('Y', $this->value)->startOfYear()->toDateTimeString();
        $end   = Carbon::createFromFormat('Y', $this->value)->endOfYear()->toDateTimeString();

        return $this->buildCondition([
            [$this->column, '<=', trim($end)],
            [$this->column, '>=', trim($start)],
        ]);
    }
}
