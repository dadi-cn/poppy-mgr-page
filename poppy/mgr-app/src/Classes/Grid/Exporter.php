<?php

namespace Poppy\MgrApp\Classes\Grid;

use Poppy\MgrApp\Classes\Grid\Exporters\AbstractExporter;
use Poppy\MgrApp\Classes\Grid\Exporters\CsvExporter;
use Poppy\MgrApp\Classes\Widgets\GridWidget;

class Exporter
{
    /**
     * Export scope constants.
     */
    const SCOPE_ALL           = 'all';
    const SCOPE_CURRENT_PAGE  = 'page';
    const SCOPE_SELECTED_ROWS = 'selected';


    // 导出的请求参数
    const QUERY_NAME = '_export';

    /**
     * Available exporter drivers.
     *
     * @var array
     */
    protected static $drivers = [];

    /**
     * @var GridWidget
     */
    protected $grid;

    /**
     * Create a new Exporter instance.
     *
     * @param GridWidget $grid
     */
    public function __construct(GridWidget $grid)
    {
        $this->grid = $grid;

        $this->grid->model()->usePaginate(false);
    }

    /**
     * Extends new exporter driver.
     *
     * @param $driver
     * @param $extend
     */
    public static function extend($driver, $extend)
    {
        static::$drivers[$driver] = $extend;
    }

    /**
     * Resolve export driver.
     *
     * @param string $driver
     *
     * @return CsvExporter
     */
    public function resolve($driver)
    {
        if ($driver instanceof AbstractExporter) {
            return $driver->setGrid($this->grid);
        }

        return $this->getExporter($driver);
    }

    /**
     * Get default exporter.
     *
     * @return CsvExporter
     */
    public function getDefaultExporter()
    {
        return new CsvExporter($this->grid);
    }

    /**
     * Format query for export url.
     *
     * @param int  $scope
     * @param null $args
     *
     * @return array
     */
    public static function formatExportQuery($scope = '', $args = null)
    {
        $query = '';

        if ($scope == static::SCOPE_ALL) {
            $query = 'all';
        }

        if ($scope == static::SCOPE_CURRENT_PAGE) {
            $query = "page:$args";
        }

        if ($scope == static::SCOPE_SELECTED_ROWS) {
            $query = "selected:$args";
        }

        return [self::QUERY_NAME => $query];
    }

    /**
     * Get export driver.
     *
     * @param string $driver
     *
     * @return CsvExporter
     */
    protected function getExporter($driver)
    {
        if (!array_key_exists($driver, static::$drivers)) {
            return $this->getDefaultExporter();
        }

        return new static::$drivers[$driver]($this->grid);
    }
}
