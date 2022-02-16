<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

class Month extends Date
{
    /**
     * @inheritDoc
     */
    protected $query = 'whereMonth';

    /**
     * @var string
     */
    protected $fieldName = 'month';
}
