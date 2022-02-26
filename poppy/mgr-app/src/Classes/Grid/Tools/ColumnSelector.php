<?php

namespace Poppy\MgrApp\Classes\Grid\Tools;

use Illuminate\Support\Collection;
use Poppy\MgrApp\Classes\Widgets\GridWidget;
use Poppy\MgrApp\Grid\Tools\Grid;

class ColumnSelector extends AbstractTool
{
    const SELECT_COLUMN_NAME = '_columns_';

    /**
     * @var GridWidget
     */
    protected $grid;

    /**
     * @var array
     */
    protected static $ignoredColumns = [
        Grid\Column::NAME_SELECTOR,
        Grid\Column::NAME_ACTION,
    ];

    /**
     * Create a new Export button instance.
     *
     * @param GridWidget $grid
     */
    public function __construct(GridWidget $grid)
    {
        $this->grid = $grid;
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function render()
    {
        if (!$this->grid->showColumnSelector()) {
            return '';
        }

    }

    /**
     * @return Collection
     */
    protected function getGridColumns()
    {
        return $this->grid->columns()->map(function (Grid\Column $column) {
            $name = $column->name;

            if ($this->isColumnIgnored($name)) {
                return;
            }

            return [$name => $column->label];
        })->filter()->collapse();
    }

    /**
     * Is column ignored in column selector.
     *
     * @param string $name
     *
     * @return bool
     */
    protected function isColumnIgnored($name)
    {
        return in_array($name, static::$ignoredColumns);
    }

    /**
     * Ignore a column to display in column selector.
     *
     * @param string|array $name
     */
    public static function ignore($name)
    {
        static::$ignoredColumns = array_merge(static::$ignoredColumns, (array) $name);
    }
}
