<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;
use Poppy\MgrApp\Form\Traits\UsePlaceholder;

class Time extends FormItem
{
    use UsePlaceholder;

    protected string $format = 'HH:mm:ss';

    public function __construct(string $name, string $label)
    {
        parent::__construct($name, $label);
        $this->setAttribute('format', $this->format);
    }
}
