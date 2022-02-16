<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

class Date extends AbstractFilterItem
{
    /**
     * @inheritDoc
     */
    protected $query = 'whereDate';

    /**
     * @var string
     */
    protected $fieldName = 'date';

    /**
     * @inheritDoc
     */
    public function __construct($column, $label = '')
    {
        parent::__construct($column, $label);

        $this->{$this->fieldName}();
    }
}
