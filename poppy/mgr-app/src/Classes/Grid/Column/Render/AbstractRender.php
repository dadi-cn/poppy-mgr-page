<?php

namespace Poppy\MgrApp\Classes\Grid\Column\Render;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;
use Poppy\MgrApp\Classes\Grid\Column\Column;
use Poppy\MgrApp\Classes\Widgets\GridWidget;
use stdClass;

abstract class AbstractRender
{
    /**
     * @var Model
     */
    protected $row;

    /**
     * @var GridWidget
     */
    protected GridWidget $grid;

    /**
     * @var Column
     */
    protected Column $column;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * 创建一个渲染实例
     * @param mixed          $value
     * @param GridWidget     $grid
     * @param Column         $column
     * @param stdClass|array $row
     */
    public function __construct($value, GridWidget $grid, Column $column, $row)
    {
        $this->value  = $value;
        $this->grid   = $grid;
        $this->column = $column;
        $this->row    = $row;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return GridWidget
     */
    public function getGrid(): GridWidget
    {
        return $this->grid;
    }

    /**
     * @return Column
     */
    public function getColumn(): Column
    {
        return $this->column;
    }

    /**
     * 获取当前行的数据
     * @return array|Model|stdClass
     */
    public function getRow()
    {
        return $this->row;
    }


    /**
     * Get key of current row.
     *
     * @return mixed
     */
    public function getKey()
    {
        return $this->row->{$this->grid->getPkName()};
    }


    /**
     * 渲染方法
     * @return Jsonable
     */
    abstract public function render(): Jsonable;
}
