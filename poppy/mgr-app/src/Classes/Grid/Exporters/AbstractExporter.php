<?php

namespace Poppy\MgrApp\Classes\Grid\Exporters;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Poppy\MgrApp\Classes\Contracts\Exportable;
use Poppy\MgrApp\Classes\Grid\Column\Column;
use Poppy\MgrApp\Classes\Grid\Exporter;
use Poppy\MgrApp\Classes\Widgets\GridWidget;
use function collect;
use function request;

/**
 * Exporter 类
 */
abstract class AbstractExporter implements Exportable
{
    /**
     * @var GridWidget
     */
    protected $grid;

    /**
     * @var int
     */
    protected $page;

    /**
     * Create a new exporter instance.
     *
     * @param GridWidget $grid
     */
    public function __construct(GridWidget $grid = null)
    {
        $this->grid = $grid;
    }

    /**
     * Set grid for exporter.
     *
     * @param GridWidget $grid
     *
     * @return $this
     */
    public function setGrid(GridWidget $grid)
    {
        $this->grid = $grid;

        return $this;
    }

    /**
     * Get table of grid.
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->grid->model()->eloquent()->getTable();
    }

    /**
     * 获取数据
     * @return Collection
     * @throws Exception
     */
    public function getData(): Collection
    {
        return $this->grid->getFilter()->execute();
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
     * @return Collection
     * @throws Exception
     */
    public function getCollection()
    {
        return collect($this->getData());
    }

    /**
     * @return Builder|Model
     */
    public function getQuery()
    {
        $model = $this->grid->model();

        $queryBuilder = $model->getQueryBuilder();

        // Export data of giving page number.
        if ($this->page) {
            $keyName = $this->grid->getPkName();
            $perPage = request(GridWidget::PAGESIZE_NAME, $model->getPagesize());

            $scope = (clone $queryBuilder)
                ->select([$keyName])
                ->setEagerLoads([])
                ->forPage($this->page, $perPage)->get();

            $queryBuilder->whereIn($keyName, $scope->pluck($keyName));
        }

        return $queryBuilder;
    }

    /**
     * 为模型设置查询配置
     * @param string $scope
     * @return $this
     */
    public function withScope(string $scope = 'page'): self
    {
        if ($scope == Exporter::SCOPE_ALL || $scope === Exporter::SCOPE_QUERY) {
            return $this;
        }

        if ($scope == Exporter::SCOPE_PAGE) {
            $this->grid->model()->usePaginate(true);
            $this->page = input('page');
        }

        if ($scope == Exporter::SCOPE_SELECT) {
            $selected = input(Column::NAME_BATCH);
            if (is_string($selected)) {
                $selected = explode(',', $selected);
            }
            $this->grid->model()->whereIn($this->grid->getPkName(), $selected);
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    abstract public function export();
}
