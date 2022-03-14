<?php

namespace Poppy\MgrApp\Classes\Grid\Tools;

use Illuminate\Support\Collection;
use Poppy\MgrApp\Classes\Widgets\GridWidget;
use Poppy\MgrApp\Grid\Tools\Grid;

class ColumnSelector extends AbstractTool
{

    /**
     * @var array
     */
    protected static $ignoredColumns = [
        Grid\Column::NAME_SELECTOR,
        Grid\Column::NAME_ACTION,
    ];

    /**
     * @var GridWidget
     */
    protected $grid;

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
     * Ignore a column to display in column selector.
     *
     * @param string|array $name
     */
    public static function ignore($name)
    {
        static::$ignoredColumns = array_merge(static::$ignoredColumns, (array) $name);
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
}
