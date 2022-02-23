<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;

class Divider extends FormItem
{
    protected bool $toModel = false;

    public function __construct(string $name, string $label)
    {
        parent::__construct($name, $label);
        $this->label = $name;
    }
}
