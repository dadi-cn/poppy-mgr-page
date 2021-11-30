<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;

class Color extends FormItem
{

    /**
     * @return $this
     */
    public function showAlpha(): self
    {
        $this->setAttribute('show-alpha', true);
        return $this;
    }

    /**
     * @return $this
     */
    public function predefine($colors): self
    {
        $this->setAttribute('predefine', $colors);
        return $this;
    }


}
