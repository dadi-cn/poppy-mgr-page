<?php

namespace Poppy\MgrApp\Classes\Grid\Filter\Presenter;

use Poppy\MgrApp\Classes\Form\Traits\UseOptions;
use Poppy\MgrApp\Classes\Form\Traits\UsePlaceholder;

class Select extends Presenter
{
    use  UsePlaceholder, UseOptions;

    protected string $type = 'select';
}
