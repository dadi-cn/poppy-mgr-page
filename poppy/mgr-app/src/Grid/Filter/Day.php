<?php

namespace Poppy\MgrApp\Grid\Filter;

class Day extends Date
{
    /**
     * @inheritDoc
     */
    protected $query = 'whereDay';

    /**
     * @var string
     */
    protected $fieldName = 'day';
}
