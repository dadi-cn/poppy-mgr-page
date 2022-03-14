<?php

namespace Poppy\MgrApp\Classes\Grid\Concerns;

trait HasSelection
{

    /**
     * 是否开启选择器
     * @var bool
     */
    protected bool $selectionEnable = false;

    /**
     * 是否开启选择器
     * @return $this
     */
    public function enableSelection(): self
    {
        $this->selectionEnable = true;
        return $this;
    }
}
