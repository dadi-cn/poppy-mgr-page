<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;
use Poppy\MgrApp\Form\Traits\UseOptions;

class Radio extends FormItem
{

    use UseOptions;

    /**
     * 设置为按钮样式
     * @return $this
     */
    public function button(): self
    {
        $this->setAttribute('button', true);
        return $this;
    }
}
