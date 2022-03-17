<?php

namespace Poppy\MgrApp\Classes\Grid\Column;

use Poppy\MgrApp\Classes\Grid\Query\Model;

class CheckFilter extends Filter
{
    /**
     * @var array
     */
    protected $options;

    /**
     * CheckFilter constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * Add a binding to the query.
     *
     * @param array $value
     * @param Model $model
     */
    public function addBinding($value, Model $model)
    {
        if (empty($value)) {
            return;
        }

        $model->whereIn($this->getColumnName(), $value);
    }
}
