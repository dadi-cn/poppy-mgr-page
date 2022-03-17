<?php

namespace Poppy\MgrApp\Classes\Grid\Column;

use Poppy\MgrApp\Classes\Grid\Query\Model;

class RangeFilter extends Filter
{
    /**
     * @var string
     */
    protected $type;

    /**
     * RangeFilter constructor.
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type  = $type;
    }

    /**
     * Add a binding to the query.
     *
     * @param mixed $value
     * @param Model $model
     */
    public function addBinding($value, Model $model)
    {
        $value = array_filter((array) $value);

        if (empty($value)) {
            return;
        }

        if (!isset($value['start'])) {
            return $model->where($this->getColumnName(), '<', $value['end']);
        }
        elseif (!isset($value['end'])) {
            return $model->where($this->getColumnName(), '>', $value['start']);
        }
        else {
            return $model->whereBetween($this->getColumnName(), array_values($value));
        }
    }

}
