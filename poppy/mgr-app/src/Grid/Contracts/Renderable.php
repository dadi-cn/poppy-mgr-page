<?php

namespace Poppy\MgrApp\Grid\Contracts;

/**
 * 操作
 */
interface Renderable
{

    /**
     * @return array
     */
    public function render(): array;
}
