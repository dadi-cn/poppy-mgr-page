<?php

namespace Poppy\MgrApp\Form\Field;

use Illuminate\Contracts\Support\Arrayable;
use Poppy\MgrApp\Form\FormItem;

class Radio extends FormItem
{

    /**
     * Set options.
     *
     * @param array|callable|string $options
     * @return $this
     */
    public function options($options = [], $complex = false): self
    {
        if ($options instanceof Arrayable) {
            $options = $options->toArray();
        }

        $this->setAttribute('options', $options);
        $this->setAttribute('complex', $complex);
        return $this;
    }

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
