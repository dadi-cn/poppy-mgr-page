<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;
use Poppy\MgrApp\Form\Traits\UsePlaceholder;

class Date extends FormItem
{

    use UsePlaceholder;

    protected string $type   = 'date';
    protected string $format = 'YYYY-MM-DD';

    public function __construct(string $name, string $label)
    {
        parent::__construct($name, $label);
        $this->setAttribute('date-type', $this->type);
        $this->setAttribute('format', $this->format);
    }
}
