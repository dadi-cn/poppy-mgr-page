<?php

namespace Poppy\MgrApp\Form\Field;

class Email extends Text
{
    protected array $rules = [
        'email',
    ];

    public function __construct(string $name, string $label)
    {
        parent::__construct($name, $label);
        $this->prefixIcon('Message');
    }
}
