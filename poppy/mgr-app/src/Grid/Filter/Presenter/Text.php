<?php

namespace Poppy\MgrApp\Grid\Filter\Presenter;

use Poppy\MgrApp\Form\Traits\UsePlaceholder;

class Text extends Presenter
{
    use UsePlaceholder;

    /**
     * @var string
     */
    protected string $type = 'text';
}
