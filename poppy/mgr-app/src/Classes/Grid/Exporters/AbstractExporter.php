<?php

namespace Poppy\MgrApp\Classes\Grid\Exporters;

use Closure;
use Exception;
use Illuminate\Support\Collection;
use Poppy\MgrApp\Classes\Contracts\Exportable;
use Poppy\MgrApp\Classes\Grid\Column\Column;
use Poppy\MgrApp\Classes\Grid\Exporter;
use Poppy\MgrApp\Classes\Widgets\GridWidget;

/**
 * Exporter 类
 */
abstract class AbstractExporter implements Exportable
{
    /**
     * @var GridWidget
     */
    protected GridWidget $grid;

    /**
     * @var int
     */
    protected int $page = 1;

    /**
     * 文件名称
     * @var string
     */
    protected string $fileName = '';

    /**
     * Create a new exporter instance.
     *
     * @param GridWidget $grid
     */
    public function __construct(GridWidget $grid)
    {
        $this->grid = $grid;
    }

    /**
     * 数据分块
     * @param Closure $callback
     * @param int     $count
     * @return bool|Collection
     * @throws Exception
     */
    public function chunk(Closure $callback, int $count = 100)
    {
        return $this->grid->getFilter()->chunk($callback, $count);
    }


    /**
     * 为模型设置查询配置
     * @param string $scope
     * @return $this
     */
    public function withScope(string $scope = 'page'): self
    {
        if ($scope == Exporter::SCOPE_ALL || $scope === Exporter::SCOPE_QUERY) {
            $this->grid->model()->usePaginate(false);
            $this->fileName = $this->title() . '-' . ($scope === 'all' ? '全部' : '查询结果');
            return $this;
        }

        if ($scope == Exporter::SCOPE_PAGE) {
            $this->grid->model()->usePaginate(true);
            $this->page     = input('page', 1);
            $this->fileName = $this->title() . "-第{$this->page}页";
        }

        if ($scope == Exporter::SCOPE_SELECT) {
            $selected = input(Column::NAME_BATCH);
            if (is_string($selected)) {
                $selected = explode(',', $selected);
            }
            $count          = count($selected);
            $this->fileName = $this->title() . "-已选择({$count})";
            $this->grid->model()->whereIn($this->grid->getPkName(), $selected);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    abstract public function export();

    private function title(): string
    {
        if (!$this->grid->title) {
            return $this->grid->model()->eloquent()->getTable();
        } else {
            return $this->grid->title;
        }
    }
}
