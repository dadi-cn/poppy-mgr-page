<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

class NotIn extends In
{
    /**
     * @inheritDoc
     */
    protected $query = 'whereNotIn';
}
