<?php

namespace Poppy\MgrApp\Grid\Column\Action;


/**
 * 页面操作
 * 页面/抽屉方式打开
 */
class PageAction extends AbstractAction
{
    /**
     * Action  渲染
     * @return array
     */
    public function render(): array
    {
        return array_merge(parent::render(), [
            'method' => 'page',
        ]);
    }
}
