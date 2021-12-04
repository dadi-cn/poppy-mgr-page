<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;

class OnOff extends FormItem
{
    /**
     * 设置开关的展示文字[开/关]
     * @return $this
     */
    public function text($on, $off = ''): self
    {
        $this->setAttribute('active-text', $on);
        $this->setAttribute('inactive-text', $off);
        return $this;
    }
}
