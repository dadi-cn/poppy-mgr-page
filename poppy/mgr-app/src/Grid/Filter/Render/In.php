<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

use Illuminate\Support\Arr;

class In extends AbstractFilterItem
{
    /**
     * @inheritDoc
     */
    protected $query = 'whereIn';

    /**
     * Get condition of this filter.
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function condition(array $inputs)
    {
        $value = Arr::get($inputs, $this->column);

        if (is_null($value)) {
            return null;
        }

        $this->value = (array) $value;

        return $this->buildCondition($this->column, $this->value);
    }
}
