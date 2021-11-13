<?php

namespace Poppy\MgrApp\Form\Field;

class Number extends Text
{

    public function __construct($column = '', $arguments = [])
    {
        parent::__construct($column, $arguments);
    }

    /**
     * Set min value of number field.
     * @param mixed $value
     * @return $this
     *
     */
    public function min($value): self
    {
        $this->fieldAttr('min', $value);
        return $this;
    }

    /**
     * Set max value of number field.
     *
     * @param mixed $value
     * @return $this
     */
    public function max($value): self
    {
        $this->fieldAttr('max', $value);
        return $this;
    }
}
