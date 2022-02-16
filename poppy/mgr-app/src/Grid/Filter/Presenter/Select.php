<?php

namespace Poppy\MgrApp\Grid\Filter\Presenter;

use Poppy\MgrApp\Form\Traits\UseOptions;
use Poppy\MgrApp\Form\Traits\UsePlaceholder;

class Select extends Presenter
{
    use  UsePlaceholder, UseOptions;

    protected string $type = 'select';
}
