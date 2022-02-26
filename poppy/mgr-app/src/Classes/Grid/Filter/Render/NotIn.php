<?php

namespace Poppy\MgrApp\Classes\Grid\Filter\Render;

class NotIn extends In
{
    /**
     * @inheritDoc
     */
    protected string $query = 'whereNotIn';
}
