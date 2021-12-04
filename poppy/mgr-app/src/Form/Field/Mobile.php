<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\Framework\Validation\Rule;

class Mobile extends Text
{

    public function __construct($column = '', $arguments = [])
    {
        parent::__construct($column, $arguments);
        $this->rules([
            Rule::mobile()
        ]);
        $this->prefixIcon('Cellphone');
    }
}
