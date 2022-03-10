<?php

namespace Poppy\MgrApp\Classes\Traits;

trait UseWidgetUtil
{

    /**
     * 检测查询类型是否存在
     * @param string $type 查询类型
     * @return bool
     */
    protected function queryHas(string $type): bool
    {
        return in_array($type, explode(',', input('_query')));
    }
}
