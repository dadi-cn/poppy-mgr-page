<?php

namespace Poppy\MgrApp\Classes\Grid\Filter;

use Illuminate\Support\Str;
use Poppy\MgrApp\Classes\Grid\Filter\Render\AbstractFilterItem;

/**
 * 表单
 */
class FilterDef
{

    /**
     * 创建表单条目
     * @param string $type  字段类型
     * @param string $name  表单字段Name
     * @param string $label 标签
     * @return AbstractFilterItem|null
     */
    public static function create(string $type, string $name, string $label): ?AbstractFilterItem
    {
        $class = __NAMESPACE__ . '\\Render\\' . Str::ucfirst($type);
        if (!class_exists($class)) {
            return null;
        }
        return new $class($name, $label);
    }

}
