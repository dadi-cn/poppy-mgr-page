<?php

namespace Poppy\MgrApp\Classes\Grid\Filter\Traits;

trait AsSelect
{

    public function asSelect($options, $placeholder): self
    {
        $this->type = 'select';
        $this->options($options);
        $this->placeholder($placeholder);
        return $this;
    }
}