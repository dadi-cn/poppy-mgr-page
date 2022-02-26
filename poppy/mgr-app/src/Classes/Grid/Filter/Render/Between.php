<?php

namespace Poppy\MgrApp\Classes\Grid\Filter\Render;

use Illuminate\Support\Arr;

class Between extends AbstractFilterItem
{

    /**
     * Get condition of this filter.
     *
     * @param array $inputs
     * @return array|null
     */
    public function condition(array $inputs) : ?array
    {
        if (!Arr::has($inputs, $this->column)) {
            return null;
        }

        $this->value = Arr::get($inputs, $this->column);

        $value = array_filter($this->value, function ($val) {
            return $val !== '';
        });

        if (empty($value)) {
            return null;
        }

        if (!($value['start'] ?? '')) {
            return $this->buildCondition($this->column, '<=', $value['end']);
        }

        if (!($value['end'] ?? '')) {
            return $this->buildCondition($this->column, '>=', $value['start']);
        }

        $this->query = 'whereBetween';

        return $this->buildCondition($this->column, $this->value);
    }
}
