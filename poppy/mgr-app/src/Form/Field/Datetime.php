<?php

namespace Poppy\MgrApp\Form\Field;

class Datetime extends Date
{
    protected $options = [
        'layui-type' => 'datetime',
    ];

    protected $itemAttr = [
        'style' => 'width: 180px',
    ];
}
