<?php

namespace Poppy\MgrApp\Grid\Filter;

class NotIn extends In
{
    /**
     * @inheritDoc
     */
    protected $query = 'whereNotIn';
}
