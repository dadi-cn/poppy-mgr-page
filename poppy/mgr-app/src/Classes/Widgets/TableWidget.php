<?php

namespace Poppy\MgrApp\Classes\Widgets;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Poppy\MgrApp\Classes\Grid\Column\Column;

/**
 * @property bool $enableSelection 是否启用选择项
 * @property array $pagesizeOptions 分页选项
 * @property Collection|Column[] $columns         所有的列数据
 */
final class TableWidget
{


    public const NAME_BATCH  = '_batch';         // 批量选择 / 导出的主键约定, pk 会和搜索冲突
    public const NAME_COLS   = '_cols';          // 支持用户选择进行查询的列定义
    public const NAME_ACTION = '_action';        // 用于定义列操作, 可以在导出时候移除
    public const NAME_SORT   = '_sort';          // 排序操作

    /**
     * 是否开启选择器
     * @var bool
     */
    protected bool $enableSelection = false;


    /**
     * 分页数选项
     * @var array|int[]
     */
    protected array $pagesizeOptions = [
        15, 30, 50, 100, 200
    ];


    /**
     * 分页数
     * @var int
     */
    protected int $pagesize = 15;

    /**
     * 列定义
     * @var Collection
     */
    private Collection $columns;

    public function __construct()
    {
        $this->columns = collect();
    }

    /**
     * 添加列到组件
     * @param string $name
     * @param string $label
     * @return Column
     */
    public function add(string $name, string $label = '')
    {
        if (Str::contains($name, '.')) {
            return $this->addRelationColumn($name, $label);
        }

        if (Str::contains($name, '->')) {
            return $this->addJsonColumn($name, $label);
        }

        return $this->addColumn($name, $label);
    }

    /**
     * 添加列操作
     * @param Closure $closure
     * @param string $title
     * @return Column
     */
    public function action(Closure $closure, string $title = '操作'): Column
    {
        return $this->add(self::NAME_ACTION, $title)->actions($closure);
    }

    /**
     * 设置列
     * @param Collection $cols
     * @return TableWidget
     */
    public function setColumns(Collection $cols): self
    {
        $this->columns = $cols;
        return $this;
    }

    /**
     * 可见的列实例
     * @return Column[]|Collection
     */
    public function visibleCols(): Collection
    {
        $visible = $this->visibleColsName();

        if (empty($visible)) {
            return $this->columns;
        }

        return $this->columns->filter(function (Column $column) use ($visible) {
            return in_array($column->name, $visible);
        });
    }

    /**
     * 可见列名称
     * @return array|string[]
     */
    public function visibleColsName(): array
    {
        $columns = explode(',', request(self::NAME_COLS));
        return array_filter($columns) ?: $this->defaultVisibleColsName();
    }

    /**
     * 获取属性
     * @param string $name 属性名称
     * @return string
     */
    public function __get(string $name)
    {
        return $this->{$name} ?? '';
    }

    /**
     * 是否开启选择器
     * @return $this
     */
    public function enableSelection(): self
    {
        $this->enableSelection = true;
        return $this;
    }

    /**
     * 默认可见列名称, 除了不隐藏, 均为可见
     * @return array
     */
    private function defaultVisibleColsName(): array
    {
        $names = collect();
        $this->columns->each(function (Column $column) use ($names) {
            if (!$column->hide) {
                $names->push($column->name);
            }
        });
        return $names->toArray();
    }

    /**
     * 添加关系列
     * @param string $name
     * @param string $label
     * @return $this|bool|Column
     */
    private function addRelationColumn(string $name, string $label = ''): Column
    {
        [$relation, $column] = explode('.', $name);

        $name = Str::snake($relation) . '.' . $column;

        return $this->addColumn($name, $label)->setRelation($relation, $column);
    }

    /**
     * 添加 Json 类型列
     * @param string $name
     * @param string $label
     * @return Column
     */
    private function addJsonColumn(string $name, string $label = ''): Column
    {
        $column = Str::after($name, '->');

        $name = str_replace('->', '.', $name);

        return $this->addColumn($name, $label ?: ucfirst($column));
    }

    /**
     * 添加列
     * @param string $column
     * @param string $label
     * @return Column
     */
    private function addColumn(string $column = '', string $label = ''): Column
    {
        $column = new Column($column, $label);
        return tap($column, function ($value) {
            $this->columns->push($value);
        });
    }
}
