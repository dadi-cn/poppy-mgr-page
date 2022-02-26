<?php

namespace Poppy\MgrApp\Classes\Grid\Filter\Presenter;

use Poppy\MgrApp\Classes\Form\Traits\UsePlaceholder;

class Text extends Presenter
{
    use UsePlaceholder;

    /**
     * @var string
     */
    protected string $type = 'text';
}
