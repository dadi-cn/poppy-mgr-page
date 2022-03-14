<?php

namespace Poppy\MgrApp\Classes\Grid;

use Poppy\MgrApp\Classes\Grid\Exporters\AbstractExporter;
use Poppy\MgrApp\Classes\Grid\Exporters\CsvExporter;
use Poppy\MgrApp\Classes\Widgets\GridWidget;

/**
 * 导出工具
 */
class Exporter
{
    /**
     * Export scope constants.
     */
    const SCOPE_ALL    = 'all';        // 所有数据, 看需要是否返回, All 会比较敏感, 不建议开启
    const SCOPE_PAGE   = 'page';       // 查询当前页数据,使用分页, 使用查询条件
    const SCOPE_QUERY  = 'query';      // 查询条件下所有数据
    const SCOPE_SELECT = 'select';     // 根据 PK, 返回所有的查询数据

    /**
     * Available exporter drivers.
     *
     * @var array
     */
    protected static array $drivers = [];

    /**
     * @var GridWidget
     */
    protected GridWidget $grid;

    /**
     * 扩展新实例
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
     * 获取导出工具
     * @param string $driver
     * @return AbstractExporter
     */
    public function resolve(string $driver): AbstractExporter
    {
        if (!array_key_exists($driver, static::$drivers)) {
            return $this->getDefaultExporter();
        }

        return new static::$drivers[$driver]($this->grid);
    }

    /**
     * 获取默认的导出工具
     * @return CsvExporter
     */
    public function getDefaultExporter(): CsvExporter
    {
        return new CsvExporter($this->grid);
    }
}
