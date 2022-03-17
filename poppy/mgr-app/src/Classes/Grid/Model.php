<?php

namespace Poppy\MgrApp\Classes\Grid;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Widgets\GridWidget;
use function collect;
use function request;

class Model
{
    /**
     * Eloquent model instance of the grid model.
     *
     * @var EloquentModel | Builder |QueryBuilder
     */
    protected $model;

    /**
     * @var EloquentModel
     */
    protected $originalModel;

    /**
     * Array of queries of the eloquent model.
     *
     * @var Collection
     */
    protected $queries;

    /**
     * Sort parameters of the model.
     *
     * @var array
     */
    protected $sort;

    /**
     * @var array
     */
    protected $data = [];

    /*
     * 15 items per page as default.
     * @var int
     */
    protected $pagesize = 15;

    /**
     * 使用分页
     * @var bool
     */
    protected bool $usePaginate = true;

    /**
     * 对查询出来的数据集合进行回调, 参数是查询的所有数据
     * @var ?Closure
     */
    protected ?Closure $collectionCallback = null;

    /**
     * @var GridWidget
     */
    protected $grid;

    /**
     * @var Relation
     */
    protected $relation;

    /**
     * @var array
     */
    protected $eagerLoads = [];

    /**
     * Create a new grid model instance.
     *
     * @param EloquentModel   $model
     * @param GridWidget|null $grid
     */
    public function __construct(EloquentModel $model, GridWidget $grid = null)
    {
        $this->model = $model;

        $this->originalModel = $model;

        $this->grid = $grid;

        $this->queries = collect();

        //        static::doNotSnakeAttributes($this->model);
    }

    /**
     * @return EloquentModel
     */
    public function getOriginalModel()
    {
        return $this->originalModel;
    }

    /**
     * Get the eloquent model of the grid model.
     *
     * @return EloquentModel
     */
    public function eloquent()
    {
        return $this->model;
    }

    /**
     * 启用或者禁用分页
     * @param bool $use
     */
    public function usePaginate(bool $use = true)
    {
        $this->usePaginate = $use;
    }

    /**
     * Get per-page number.
     *
     * @return int
     */
    public function getPagesize(): int
    {
        return $this->pagesize;
    }

    /**
     * 设置分页数量
     * @param int $pagesize
     * @return $this
     */
    public function setPagesize(int $pagesize): self
    {
        $this->pagesize = $pagesize;
        $this->__call('paginate', [$pagesize]);
        return $this;
    }

    /**
     * @return Relation
     */
    public function getRelation()
    {
        return $this->relation;
    }

    /**
     * @param Relation $relation
     *
     * @return $this
     */
    public function setRelation(Relation $relation)
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * Get constraints.
     *
     * @return array|bool
     */
    public function getConstraints()
    {
        if ($this->relation instanceof HasMany) {
            return [
                $this->relation->getForeignKeyName() => $this->relation->getParentKey(),
            ];
        }

        return false;
    }

    /**
     * Set collection callback.
     *
     * @param Closure|null $callback
     *
     * @return $this
     */
    public function collection(Closure $callback = null)
    {
        $this->collectionCallback = $callback;

        return $this;
    }

    /**
     * 组建数据
     * @throws Exception
     */
    public function buildData(): Collection
    {
        $collection = $this->get();

        if ($this->collectionCallback) {
            $collection = call_user_func($this->collectionCallback, $collection);
        }

        $this->data = $collection;
        return $this->data;
    }

    /**
     * @param Closure $callback
     * @param int     $count
     * @return Collection|bool
     * @throws Exception
     */
    public function chunk(Closure $callback, int $count = 100)
    {
        if ($this->usePaginate) {
            return $this->buildData()->chunk($count)->each($callback);
        }

        $this->setSort();

        $this->queries->reject(function ($query) {
            return $query['method'] == 'paginate';
        })->each(function ($query) {
            $this->model = $this->model->{$query['method']}(...$query['arguments']);
        });

        return $this->model->chunk($count, $callback);
    }

    /**
     * 添加条件到 Model
     * @param array $conditions
     * @return $this
     */
    public function addConditions(array $conditions): self
    {
        foreach ($conditions as $condition) {
            // [$this, where][title, like, '%我%']
            call_user_func_array([$this, key($condition)], current($condition));
        }

        return $this;
    }


    /**
     * @return Builder|EloquentModel
     */
    public function getQueryBuilder()
    {
        if ($this->relation) {
            return $this->relation->getQuery();
        }

        $this->setSort();

        $queryBuilder = $this->originalModel;

        $this->queries->reject(function ($query) {
            return in_array($query['method'], ['get', 'paginate']);
        })->each(function ($query) use (&$queryBuilder) {
            $queryBuilder = $queryBuilder->{$query['method']}(...$query['arguments']);
        });

        return $queryBuilder;
    }

    /**
     * Reset orderBy query.
     *
     * @return void
     */
    public function resetOrderBy()
    {
        $this->queries = $this->queries->reject(function ($query) {
            return $query['method'] == 'orderBy' || $query['method'] == 'orderByDesc';
        });
    }

    /**
     * 调用查询方法并把参数放入到查询条件中
     * @param string $method
     * @param array  $arguments
     * @return $this
     */
    public function __call(string $method, array $arguments)
    {
        $this->queries->push([
            'method'    => $method,
            'arguments' => $arguments,
        ]);

        return $this;
    }


    /**
     * @param mixed  $id
     * @param string $field
     * @param string $value
     * @return bool
     */
    public function edit($id, string $field, string $value): bool
    {
        $pk = $this->originalModel->getKeyName();
        if (!$pk) {
            return false;
        }
        $this->originalModel->where($pk, $id)->update([
            $field => $value,
        ]);
        return true;
    }

    /**
     * Set the relationships that should be eager loaded.
     *
     * @param mixed $relations
     *
     * @return $this|Model
     */
    public function with($relations)
    {
        if (is_array($relations)) {
            if (Arr::isAssoc($relations)) {
                $relations = array_keys($relations);
            }

            $this->eagerLoads = array_merge($this->eagerLoads, $relations);
        }

        if (is_string($relations)) {
            if (Str::contains($relations, '.')) {
                $relations = explode('.', $relations)[0];
            }

            if (Str::contains($relations, ':')) {
                $relations = explode(':', $relations)[0];
            }

            if (in_array($relations, $this->eagerLoads)) {
                return $this;
            }

            $this->eagerLoads[] = $relations;
        }

        return $this->__call('with', (array) $relations);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        $data = $this->buildData();

        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
    }

    /**
     * @return Collection
     * @throws Exception
     */
    protected function get()
    {
        if ($this->relation) {
            $this->model = $this->relation->getQuery();
        }

        $this->setSort();

        $this->setPaginate();


        $this->queries->unique()->each(function ($query) {
            $this->model = call_user_func_array([$this->model, $query['method']], $query['arguments']);
        });


        if ($this->model instanceof Collection) {
            return $this->model;
        }

        if ($this->model instanceof LengthAwarePaginator) {
            return $this->model->getCollection();
        }

        throw new ApplicationException('当前查询方式不支持非指定数据查询');
    }


    /**
     * 设置分页
     * @return void
     */
    protected function setPaginate()
    {
        // [paginate, [15]]
        $paginate = $this->findQueryByMethod('paginate');

        // 从集合中删除分页方法
        $this->queries = $this->queries->reject(function ($query) {
            return $query['method'] == 'paginate';
        });

        if ($this->usePaginate) {
            // 组合分页条件
            $query = [
                'method'    => 'paginate',
                'arguments' => $this->resolvePagesize($paginate),
            ];

            $this->queries->push($query);
        }
    }

    /**
     * Resolve perPage for pagination.
     *
     * @param array|null $paginate
     * @return array
     */
    protected function resolvePagesize($paginate)
    {
        if ($pagesize = request(GridWidget::PAGESIZE_NAME)) {
            if (is_array($paginate)) {
                $paginate['arguments'][0] = (int) $pagesize;

                return $paginate['arguments'];
            }

            $this->pagesize = (int) $pagesize;
        }

        if (isset($paginate['arguments'][0])) {
            return $paginate['arguments'];
        }

        return [$this->pagesize];
    }

    /**
     * 通过方法名称查找组合模型的条件
     * @param string $method
     * @return array
     *              method : paginate
     *              arguments  : [15]
     */
    protected function findQueryByMethod(string $method): ?array
    {
        return $this->queries->first(function ($query) use ($method) {
            return $query['method'] == $method;
        });
    }

    /**
     * 设置排序
     * _sort {
     *    column :
     *    type :
     *    cast :
     * }
     * @return void
     */
    protected function setSort()
    {
        $this->sort = request(GridWidget::SORT_NAME, []);
        if (!is_array($this->sort)) {
            return;
        }

        if (empty($this->sort['column']) || empty($this->sort['type'])) {
            return;
        }

        if (Str::contains($this->sort['column'], '.')) {
            $this->setRelationSort($this->sort['column']);
        } else {
            $this->resetOrderBy();
            $column    = $this->sort['column'];
            $method    = 'orderBy';
            $arguments = [$column, $this->sort['type']];
            $this->queries->push([
                'method'    => $method,
                'arguments' => $arguments,
            ]);
        }
    }

    /**
     * Set relation sort.
     *
     * @param string $column
     *
     * @return void
     */
    protected function setRelationSort($column)
    {
        [$relationName, $relationColumn] = explode('.', $column);

        if ($this->queries->contains(function ($query) use ($relationName) {
            return $query['method'] == 'with' && in_array($relationName, $query['arguments']);
        })) {
            $relation = $this->model->$relationName();

            $this->queries->push([
                'method'    => 'select',
                'arguments' => [$this->model->getTable() . '.*'],
            ]);

            $this->queries->push([
                'method'    => 'join',
                'arguments' => $this->joinParameters($relation),
            ]);

            $this->resetOrderBy();

            $this->queries->push([
                'method'    => 'orderBy',
                'arguments' => [
                    $relation->getRelated()->getTable() . '.' . $relationColumn,
                    $this->sort['type'],
                ],
            ]);
        }
    }

    /**
     * Build join parameters for related model.
     *
     * `HasOne` and `BelongsTo` relation has different join parameters.
     *
     * @param Relation $relation
     *
     * @return array
     * @throws Exception
     *
     */
    protected function joinParameters(Relation $relation)
    {
        $relatedTable = $relation->getRelated()->getTable();

        if ($relation instanceof BelongsTo) {
            $foreignKeyMethod = 'getForeignKeyName';

            return [
                $relatedTable,
                $relation->{$foreignKeyMethod}(),
                '=',
                $relatedTable . '.' . $relation->getRelated()->getKeyName(),
            ];
        }

        if ($relation instanceof HasOne) {
            return [
                $relatedTable,
                $relation->getQualifiedParentKeyName(),
                '=',
                $relation->getQualifiedForeignKeyName(),
            ];
        }

        throw new Exception('Related sortable only support `HasOne` and `BelongsTo` relation.');
    }
}
