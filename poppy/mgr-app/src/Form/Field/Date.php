<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;
use Poppy\MgrApp\Form\Traits\PlainInput;

class Date extends FormItem
{
    use PlainInput;

    protected $options = [
        'type' => 'date',
    ];

    protected $itemAttr = [
        'style' => 'width: 110px',
    ];

    protected $view = 'py-system::tpl.form.date';

    public function render()
    {

        $this->prepend('<i class="fa fa-calendar fa-fw"></i>');
        $this->addVariables([
            'prepend' => $this->prepend,
            'options' => $this->options,
        ]);
        return parent::render();
    }
}
