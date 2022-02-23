<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

class NotIn extends In
{
    /**
     * @inheritDoc
     */
    protected string $query = 'whereNotIn';
}
