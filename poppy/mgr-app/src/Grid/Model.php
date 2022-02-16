<?php

namespace Poppy\MgrApp\Grid;

use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Widgets\GridWidget;

class Model
{
    /**
     * Eloquent model instance of the grid model.
     *
     * @var EloquentModel
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
     * 20 items per page as default.
     *
     * @var int
     */
    protected $pagesize = 20;

    /**
     * If the model use pagination.
     *
     * @var bool
     */
    protected $usePaginate = true;

    /**
     * The query string variable used to store the per-page.
     *
     * @var string
     */
    protected string $pagesizeName = 'pagesize';

    /**
     * The query string variable used to store the sort.
     *
     * @var string
     */
    protected string $sortName = '_sort';

    /**
     * Collection callback.
     *
     * @var Closure
     */
    protected $collectionCallback;

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
     * Enable or disable pagination.
     *
     * @param bool $use
     */
    public function usePaginate($use = true)
    {
        $this->usePaginate = $use;
    }

    /**
     * Get the query string variable used to store the per-page.
     *
     * @return string
     */
    public function getPagesizeName()
    {
        return $this->pagesizeName;
    }

    /**
     * Set the query string variable used to store the per-page.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setPagesizeName($name)
    {
        $this->pagesizeName = $name;

        return $this;
    }

    /**
     * Get per-page number.
     *
     * @return int
     */
    public function getPagesize()
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
     * Get the query string variable used to store the sort.
     *
     * @return string
     */
    public function getSortName()
    {
        return $this->sortName;
    }

    /**
     * Set the query string variable used to store the sort.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setSortName($name)
    {
        $this->sortName = $name;

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
     * Build.
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
     * @param callable $callback
     * @param int      $count
     * @throws Exception
     */
    public function chunk($callback, $count = 100)
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
     * Get table of the model.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->model->getTable();
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

        throw new ApplicationException('Grid query error');
    }


    /**
     * Set the grid paginate.
     *
     * @return void
     */
    protected function setPaginate()
    {
        $paginate = $this->findQueryByMethod('paginate');

        $this->queries = $this->queries->reject(function ($query) {
            return $query['method'] == 'paginate';
        });

        $query = [
            'method'    => 'paginate',
            'arguments' => $this->resolvePerPage($paginate),
        ];

        $this->queries->push($query);
    }

    /**
     * Resolve perPage for pagination.
     *
     * @param array|null $paginate
     *
     * @return array
     */
    protected function resolvePerPage($paginate)
    {
        if ($pagesize = request($this->pagesizeName)) {
            if (is_array($paginate)) {
                $paginate['arguments'][0] = (int) $pagesize;

                return $paginate['arguments'];
            }

            $this->pagesize = (int) $pagesize;
        }

        if (isset($paginate['arguments'][0])) {
            return $paginate['arguments'];
        }

        if ($name = $this->grid->getName()) {
            return [$this->pagesize, ['*'], "{$name}_page"];
        }

        return [$this->pagesize];
    }

    /**
     * 通过方法名称查找组合模型的条件
     * @param $method
     * @return array
     *              method : paginate
     *              arguments  : [15]
     */
    protected function findQueryByMethod($method): ?array
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
     *    cast
     * }
     * @return void
     */
    protected function setSort()
    {
        $this->sort = request($this->sortName, []);
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

            // get column. if contains "cast", set set column as cast
            if (!empty($this->sort['cast'])) {
                $column    = "CAST({$this->sort['column']} AS {$this->sort['cast']}) {$this->sort['type']}";
                $method    = 'orderByRaw';
                $arguments = [$column];
            } else {
                $column    = $this->sort['column'];
                $method    = 'orderBy';
                $arguments = [$column, $this->sort['type']];
            }

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

    /**
     * Don't snake case attributes.
     *
     * @param EloquentModel $model
     *
     * @return void
     */
    protected static function doNotSnakeAttributes(EloquentModel $model)
    {
        $class = get_class($model);

        $class::$snakeAttributes = false;
    }
}
