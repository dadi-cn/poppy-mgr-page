<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

class Year extends Date
{
    /**
     * @inheritDoc
     */
    protected $query = 'whereYear';

    /**
     * @var string
     */
    protected $fieldName = 'year';
}
