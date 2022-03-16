<?php

namespace Poppy\MgrApp\Http\Grid;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Grid\Column\Column;
use Poppy\MgrApp\Classes\Grid\Column\Render\ActionsRender;
use Poppy\MgrApp\Classes\Grid\Tools\Actions;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Classes\Widgets\GridWidget;
use Poppy\System\Models\PamAccount;

/**
 * @property-read string $title       标题
 */
abstract class GridBase implements GridContract
{
    use Macroable {
        __call as macroCall;
    }

    /**
     * 标题
     * @var string
     */
    protected string $title = '';

    /**
     * @var GridWidget
     */
    protected GridWidget $grid;


    /**
     * 列定义
     * @var Collection
     */
    protected Collection $columns;

    /**
     * @var PamAccount
     */
    protected $pam;

    public function __construct(GridWidget $grid)
    {
        $this->pam     = app('auth')->user();
        $this->grid    = $grid;
        $this->columns = collect();
    }


    /**
     * 添加列到 Grid
     * @param string $name
     * @param string $label
     *
     * @return Column
     * @throws ApplicationException
     */
    public function column(string $name, string $label = '')
    {
        if (Str::contains($name, '.')) {
            return $this->addRelationColumn($name, $label);
        }

        if (Str::contains($name, '->')) {
            return $this->addJsonColumn($name, $label);
        }

        return $this->__call($name, array_filter([$label]));
    }

    /**
     * 添加列操作
     * @param Closure $closure
     * @param string  $title
     * @return Column
     * @throws ApplicationException
     */
    public function action(Closure $closure, string $title = '操作'): Column
    {
        return $this->column(Column::NAME_ACTION, $title)->displayUsing(ActionsRender::class, [$closure]);
    }

    /**
     * 动态添加列到 View
     * @param string $method
     * @param array  $parameters
     *
     * @return Column
     */
    public function __call(string $method, array $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        $label = $parameters[0] ?? '';

        if ($this->model()->eloquent()) {
            return $this->addColumn($method, $label);
        }

        if ($column = $this->handleGetMutatorColumn($method, $label)) {
            return $column;
        }

        if ($column = $this->handleRelationColumn($method, $label)) {
            return $column;
        }

        return $this->addColumn($method, $label);
    }

    /**
     * @return Collection
     */
    public function getColumns(): Collection
    {
        return $this->columns;
    }

    public function filter(FilterWidget $filter)
    {
    }

    public function quickActions(Actions $actions)
    {
    }

    public function batchActions(Actions $actions)
    {
    }

    public function __get($attr)
    {
        if (in_array($attr, ['title'])) {
            return $this->{$attr};
        }
        return null;
    }

    /**
     * 添加关系列
     * @param string $name
     * @param string $label
     * @return $this|bool|Column
     * @throws ApplicationException
     */
    protected function addRelationColumn(string $name, string $label = ''): Column
    {
        [$relation, $column] = explode('.', $name);

        $model = $this->model()->eloquent();

        if (!method_exists($model, $relation) || !$model->{$relation}() instanceof Relation) {
            $class = get_class($model);
            throw new ApplicationException("Call to undefined relationship [{$relation}] on model [{$class}].");
        }

        $name = Str::snake($relation) . '.' . $column;

        $this->model()->with($relation);

        return $this->addColumn($name, $label)->setRelation($relation, $column);
    }

    /**
     * 添加 Json 类型列
     * @param string $name
     * @param string $label
     * @return Column
     */
    protected function addJsonColumn(string $name, string $label = ''): Column
    {
        $column = substr($name, strrpos($name, '->') + 2);

        $name = str_replace('->', '.', $name);

        return $this->addColumn($name, $label ?: ucfirst($column));
    }

    /**
     * 添加列
     * @param string $column
     * @param string $label
     * @return Column
     */
    protected function addColumn(string $column = '', string $label = ''): Column
    {
        $column = new Column($column, $label);
        $column->setGrid($this->grid);
        return tap($column, function ($value) {
            $this->columns->push($value);
        });
    }

    /**
     * Handle get mutator column for grid.
     *
     * @param string $method
     * @param string $label
     *
     * @return bool|Column
     */
    protected function handleGetMutatorColumn($method, $label)
    {
        if ($this->model()->eloquent()->hasGetMutator($method)) {
            return $this->addColumn($method, $label);
        }

        return false;
    }

    /**
     * Handle relation column for grid.
     *
     * @param string $method
     * @param string $label
     *
     * @return bool|Column
     */
    protected function handleRelationColumn($method, $label)
    {
        $model = $this->model()->eloquent();

        if (!method_exists($model, $method)) {
            return false;
        }

        if (!($relation = $model->$method()) instanceof Relation) {
            return false;
        }

        if ($relation instanceof HasOne ||
            $relation instanceof BelongsTo ||
            $relation instanceof MorphOne
        ) {
            $this->model()->with($method);
            return $this->addColumn($method, $label)->setRelation(Str::snake($method));
        }

        if ($relation instanceof HasMany
            || $relation instanceof BelongsToMany
            || $relation instanceof MorphToMany
            || $relation instanceof HasManyThrough
        ) {
            $this->model()->with($method);

            return $this->addColumn(Str::snake($method), $label);
        }

        return false;
    }

    /**
     * 当前的数据模型
     * @return Model|Grid\Model
     */
    private function model()
    {
        return $this->grid->model();
    }
}
