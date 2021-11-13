<?php

namespace Poppy\MgrApp\Form\Field;

use Poppy\MgrApp\Form\FormItem;
use Poppy\System\Models\SysConfig;

class SwitchFormItem extends FormItem
{

    protected $default = 0;

    public function render()
    {
        $this->options = [
            SysConfig::NO  => '关闭',
            SysConfig::YES => '开启',
        ];
        return parent::render();
    }
}
