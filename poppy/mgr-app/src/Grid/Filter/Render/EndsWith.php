<?php

namespace Poppy\MgrApp\Grid\Filter\Render;


class EndsWith extends Like
{
    protected $exprFormat = '%{value}';
}
