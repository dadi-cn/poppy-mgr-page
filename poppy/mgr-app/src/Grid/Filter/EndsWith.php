<?php

namespace Poppy\MgrApp\Grid\Filter;

class EndsWith extends Like
{
    protected $exprFormat = '%{value}';
}
