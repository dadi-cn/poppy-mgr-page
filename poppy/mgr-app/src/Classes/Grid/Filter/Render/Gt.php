<?php

namespace Poppy\MgrApp\Classes\Grid\Filter\Render;

use Illuminate\Support\Arr;

class Gt extends AbstractFilterItem
{

    /**
     * Get condition of this filter.
     *
     * @param array $inputs
     *
     * @return array|mixed|void
     */
    public function condition(array $inputs)
    {
        $value = Arr::get($inputs, $this->column);

        if (is_null($value)) {
            return;
        }

        $this->value = $value;

        return $this->buildCondition($this->column, '>=', $this->value);
    }

    public function struct(): array
    {
        $struct            = parent::struct();
        $struct['options'] = array_merge(
            $struct['options'] ?? [], [
                'prepend' => '大于'
            ]
        );
        return $struct;
    }
}
