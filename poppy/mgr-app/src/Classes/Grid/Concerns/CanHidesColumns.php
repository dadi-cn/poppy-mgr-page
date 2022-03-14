<?php

namespace Poppy\MgrApp\Classes\Grid\Concerns;

use Illuminate\Support\Collection;
use Poppy\MgrApp\Classes\Grid\Column\Column;

trait CanHidesColumns
{
    /**
     * 默认隐藏列名称
     * @var array
     */
    public array $hiddenColumns = [];

    /**
     * 设置默认可见的列
     * @param array|string $columns
     *
     * @return $this
     */
    public function hideColumns($columns): self
    {
        if (func_num_args()) {
            $columns = (array) $columns;
        } else {
            $columns = func_get_args();
        }

        $this->hiddenColumns = array_merge($this->hiddenColumns, $columns);

        return $this;
    }

    /**
     * 可见的列实例
     * @return Column[]|Collection
     */
    public function visibleColumns(): Collection
    {
        $visible = $this->getVisibleColumnsName();

        if (empty($visible)) {
            return $this->columns;
        }

        return $this->columns->filter(function (Column $column) use ($visible) {
            return in_array($column->name, $visible);
        });
    }

    /**
     * 默认可见列名称
     * @return array
     */
    public function getDefaultVisibleColumnNames(): array
    {
        $columnNames = $this->columns->map(function (Column $column) {
            return $column->name;
        })->toArray();

        return array_values(array_diff(
            $columnNames,
            $this->hiddenColumns
        ));
    }

    /**
     * 获取请求中的查询列, 如果有请求查询, 则返回, 否则返回非隐藏列
     * @return array
     */
    public function getVisibleColumnsName(): array
    {
        $columns = explode(',', request(Column::NAME_COLS));

        $all = array_filter($columns) ?: $this->getDefaultVisibleColumnNames();

        // 默认加入主键列
        if ($this->getPkName() && !in_array($this->getPkName(), $all)) {
            array_unshift($all, $this->getPkName());
        }
        return $all;
    }
}
