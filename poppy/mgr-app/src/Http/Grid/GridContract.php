<?php

namespace Poppy\MgrApp\Http\Grid;

use Poppy\MgrApp\Classes\Grid\Tools\QuickActions;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;

interface GridContract
{
    /**
     * 添加列展示
     * @return mixed
     */
    public function columns();

    /**
     * 添加搜索项
     */
    public function filter(FilterWidget $filter);

    /**
     * 定义右上角的快捷操作栏
     */
    public function quickActions(QuickActions $actions);

    /**
     * 批量操作
     * @return array
     */
    public function batchAction(): array;
}
