<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;
use Poppy\MgrApp\Form\Traits\UseInput;

/**
 * 文本输入框
 * @property string $prepend
 */
class Text extends FormItem
{

    use UseInput;

    /**
     * 默认数据
     * @var mixed
     */
    protected $default = '';

    public function __construct(string $name, string $label)
    {
        parent::__construct($name, $label);
    }

    public function clearable(): self
    {
        $this->setAttribute('clearable', true);
        return $this;
    }

    public function prefixIcon($icon): self
    {
        $this->setAttribute('prefix-icon', $icon);
        return $this;
    }

    public function suffixIcon($icon): self
    {
        $this->setAttribute('suffix-icon', $icon);
        return $this;
    }
}
