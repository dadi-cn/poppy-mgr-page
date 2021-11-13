<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;

/**
 * 文本输入框
 * @property string $prepend
 */
class Text extends FormItem
{

    /**
     * 默认数据
     * @var mixed
     */
    protected $default = '';

    public function __construct(string $name, string $label)
    {
        parent::__construct($name, $label);
    }
}
