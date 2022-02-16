<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

use Illuminate\Support\Arr;

class NotEqual extends AbstractFilterItem
{
    /**
     * @inheritDoc
     */
    public function condition(array $inputs)
    {
        $value = Arr::get($inputs, $this->column);

        if (!isset($value)) {
            return;
        }

        $this->value = $value;

        return $this->buildCondition($this->column, '!=', $this->value);
    }
}
