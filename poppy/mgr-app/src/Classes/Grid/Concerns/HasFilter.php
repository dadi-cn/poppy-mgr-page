<?php

namespace Poppy\MgrApp\Classes\Grid\Concerns;

use Closure;
use Exception;
use Illuminate\Support\Collection;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;

/**
 * 是否开启筛选
 */
trait HasFilter
{
    /**
     * @var FilterWidget
     */
    protected FilterWidget $filter;

    /**
     * 获取筛选
     *
     * @return FilterWidget
     */
    public function getFilter(): FilterWidget
    {
        return $this->filter;
    }

    /**
     * 执行查询器
     * @return Collection
     * @throws Exception
     */
    public function applyFilter(): Collection
    {
        return $this->filter->execute();
    }

    /**
     * Set the grid filter.
     * @param Closure $callback
     */
    public function filter(Closure $callback)
    {
        call_user_func($callback, $this->filter);
    }

    /**
     * 初始化筛选
     * @return $this
     */
    protected function initFilter(): self
    {
        $this->filter = new FilterWidget($this->model);
        return $this;
    }
}
