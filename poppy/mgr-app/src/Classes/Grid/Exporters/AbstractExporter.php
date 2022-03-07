<?php

namespace Poppy\MgrApp\Classes\Grid\Exporters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Poppy\MgrApp\Classes\Grid\Exporter;
use Poppy\MgrApp\Classes\Widgets\GridWidget;
use function collect;
use function request;

abstract class AbstractExporter implements ExporterInterface
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
     * @param $grid
     */
    public function __construct(GridWidget $grid = null)
    {
        if ($grid) {
            $this->setGrid($grid);
        }
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
    public function getTable()
    {
        return $this->grid->model()->eloquent()->getTable();
    }

    /**
     * Get data with export query.
     *
     * @param bool $toArray
     *
     * @return array|Collection|mixed
     */
    public function getData()
    {
        return $this->grid->getFilter()->execute();
    }

    /**
     * @param callable $callback
     * @param int      $count
     *
     * @return bool
     */
    public function chunk(callable $callback, $count = 100)
    {
        return $this->grid->getFilter()->chunk($callback, $count);
    }

    /**
     * @return Collection
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
        $model = $this->grid->getFilter()->getModel();

        $queryBuilder = $model->getQueryBuilder();

        // Export data of giving page number.
        if ($this->page) {
            $keyName = $this->grid->getKeyName();
            $perPage = request($model->getPerPageName(), $model->getPerPage());

            $scope = (clone $queryBuilder)
                ->select([$keyName])
                ->setEagerLoads([])
                ->forPage($this->page, $perPage)->get();

            $queryBuilder->whereIn($keyName, $scope->pluck($keyName));
        }

        return $queryBuilder;
    }

    /**
     * Export data with scope.
     *
     * @param string $scope
     *
     * @return $this
     */
    public function withScope($scope)
    {
        if ($scope == Exporter::SCOPE_ALL) {
            return $this;
        }

        [$scope, $args] = explode(':', $scope);

        if ($scope == Exporter::SCOPE_CURRENT_PAGE) {
            $this->grid->model()->usePaginate(true);
            $this->page = $args ?: 1;
        }

        if ($scope == Exporter::SCOPE_SELECTED_ROWS) {
            $selected = explode(',', $args);
            $this->grid->model()->whereIn($this->grid->getKeyName(), $selected);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    abstract public function export();
}
