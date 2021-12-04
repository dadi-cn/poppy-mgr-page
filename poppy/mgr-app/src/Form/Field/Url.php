<?php

namespace Poppy\MgrApp\Form\Field;

class Url extends Text
{
    protected array $rules = [
        'url',
    ];

    public function __construct(string $name, string $label)
    {
        parent::__construct($name, $label);
        $this->prefixIcon('Link');
    }
}
