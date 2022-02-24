<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Grid\Filter\Render\Model;

/**
 * 筛选器
 *
 */
abstract class FilterItem
{
    /**
     * @var array
     */
    protected static $supports = [
    ];

    /**
     * 是否展开
     * @var bool
     */
    public        $expand = false;

    protected int $width  = 1;

    /**
     * 当前的模型
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * 搜索表单的筛选条件
     *
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var Collection
     */
    protected $scopes;

    /**
     * Set this filter only in the layout.
     *
     * @var bool
     */
    protected $thisFilterLayoutOnly = false;

    /**
     * Columns of filter that are layout-only.
     *
     * @var array
     */
    protected $layoutOnlyFilterColumns = [];

    /**
     * Primary key of giving model.
     *
     * @var mixed
     */
    protected $primaryKey;

    /**
     * Set action of search form.
     *
     * @param string $action
     *
     * @return $this
     */
    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get grid model.
     *
     * @return Model
     */
    public function getModel()
    {
        $conditions = array_merge(
            $this->conditions(),
            $this->scopeConditions()
        );

        return $this->model->addConditions($conditions);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * 设置列宽度
     * @return $this
     */
    public function width($width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Remove filter by filter id.
     *
     * @param mixed $id
     */
    public function removeFilterByID($id)
    {
        $this->filters = array_filter($this->filters, function (AbstractFilterItem $filter) use ($id) {
            return $filter->getId() != $id;
        });
    }

    /**
     * Get all conditions of the filters.
     *
     * @return array
     */
    public function conditions(): array
    {
        $inputs = Arr::dot(request()->all());

        $inputs = array_filter($inputs, function ($input) {
            return $input !== '' && !is_null($input);
        });

        $this->sanitizeInputs($inputs);

        if (empty($inputs)) {
            return [];
        }

        $params = [];

        foreach ($inputs as $key => $value) {
            Arr::set($params, $key, $value);
        }

        $conditions = [];

        foreach ($this->filters() as $filter) {
            if (in_array($column = $filter->getColumn(), $this->layoutOnlyFilterColumns)) {
                $filter->default(Arr::get($params, $column));
            } else {
                $conditions[] = $filter->condition($params);
            }
        }

        return array_filter($conditions);
    }

    /**
     * Set this filter layout only.
     *
     * @return $this
     */
    public function layoutOnly()
    {
        $this->thisFilterLayoutOnly = true;

        return $this;
    }

    /**
     * Use a custom filter.
     *
     * @param AbstractFilterItem $filter
     *
     * @return AbstractFilterItem
     */
    public function use(AbstractFilterItem $filter)
    {
        return $this->addFilter($filter);
    }

    /**
     * Get all filters.
     *
     * @return AbstractFilterItem[]
     */
    public function filters(): array
    {
        return $this->filters;
    }

    /**
     * @param string $key
     * @param string $label
     *
     * @return mixed
     */
    public function scope($key, $label = '')
    {
        return tap(new Scope($key, $label), function (Scope $scope) {
            return $this->scopes->push($scope);
        });
    }

    /**
     * Get all filter scopes.
     *
     * @return Collection
     */
    public function getScopes(): Collection
    {
        return $this->scopes;
    }

    /**
     * Get current scope.
     *
     * @return Scope|null
     */
    public function getCurrentScope()
    {
        $key = request(Scope::QUERY_NAME);

        return $this->scopes->first(function ($scope) use ($key) {
            return $scope->key == $key;
        });
    }


    /**
     * Execute the filter with conditions.
     *
     * @param bool $toArray
     *
     * @return array|Collection|mixed
     */
    public function execute($toArray = true)
    {
        if (method_exists($this->model->eloquent(), 'paginate')) {
            $this->model->usePaginate();

            return $this->model->buildData($toArray);
        }
        $conditions = array_merge(
            $this->conditions(),
            $this->scopeConditions()
        );

        return $this->model->addConditions($conditions)->buildData($toArray);
    }

    /**
     * @param callable $callback
     * @param int      $count
     *
     * @return bool
     */
    public function chunk(callable $callback, $count = 100)
    {
        $conditions = array_merge(
            $this->conditions(),
            $this->scopeConditions()
        );

        return $this->model->addConditions($conditions)->chunk($callback, $count);
    }

    /**
     * Get url without filter queryString.
     *
     * @return string
     */
    public function urlWithoutFilters()
    {
        /** @var Collection $columns */
        $columns = collect($this->filters)->map->getColumn()->flatten();

        $pageKey = 'page';

        if ($gridName = $this->model->getGrid()->getName()) {
            $pageKey = "{$gridName}_{$pageKey}";
        }

        $columns->push($pageKey);

        $groupNames = collect($this->filters)->filter(function ($filter) {
            return $filter instanceof Filter\Group;
        })->map(function (AbstractFilterItem $filter) {
            return "{$filter->getId()}_group";
        });

        return $this->fullUrlWithoutQuery(
            $columns->merge($groupNames)
        );
    }

    /**
     * Get url without scope queryString.
     *
     * @return string
     */
    public function urlWithoutScopes()
    {
        return $this->fullUrlWithoutQuery(Scope::QUERY_NAME);
    }

    /**
     * @param string $abstract
     * @param array  $arguments
     *
     * @return AbstractFilterItem
     * @throws ApplicationException
     */
    public function resolveFilter(string $abstract, array $arguments): AbstractFilterItem
    {
        if (!isset(static::$supports[$abstract])) {
            throw new ApplicationException('Abstract Class `' . $abstract . '` Not Exists');
        }
        return new static::$supports[$abstract](...$arguments);
    }

    /**
     * Generate a filter object and add to grid.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return AbstractFilterItem|$this
     * @throws ApplicationException
     */
    public function __call(string $method, array $arguments)
    {
        $filter = $this->resolveFilter($method, $arguments);
        return tap($filter, function (FilterItem $filter) {
            $this->addFilter($filter);
        });

    }

    /**
     * @param string $name
     * @param string $filterClass
     */
    public static function extend($name, $filterClass)
    {
        if (!is_subclass_of($filterClass, AbstractFilterItem::class)) {
            throw new InvalidArgumentException("The class [$filterClass] must be a type of " . AbstractFilterItem::class . '.');
        }

        static::$supports[$name] = $filterClass;
    }

    /**
     * @param $inputs
     *
     * @return array
     */
    protected function sanitizeInputs(&$inputs)
    {
        if (!$this->name) {
            return $inputs;
        }

        $inputs = collect($inputs)->filter(function ($input, $key) {
            return Str::startsWith($key, "{$this->name}_");
        })->mapWithKeys(function ($val, $key) {
            $key = str_replace("{$this->name}_", '', $key);
            return [$key => $val];
        })->toArray();
    }

    /**
     * Add a filter to grid.
     *
     * @param FilterItem $filter
     *
     * @return AbstractFilterItem
     */
    protected function addFilter(FilterItem $filter): self
    {
        $this->filters[] = $filter;
        return $this;
    }

    /**
     * Get scope conditions.
     *
     * @return array
     */
    protected function scopeConditions(): array
    {
        if ($scope = $this->getCurrentScope()) {
            return $scope->condition();
        }

        return [];
    }

    /**
     * Get full url without query strings.
     *
     * @param Arrayable|array|string $keys
     *
     * @return string
     */
    protected function fullUrlWithoutQuery($keys): string
    {
        if ($keys instanceof Arrayable) {
            $keys = $keys->toArray();
        }

        $keys = (array) $keys;

        $request = request();

        $query = $request->query();
        Arr::forget($query, $keys);

        $question = $request->getBaseUrl() . $request->getPathInfo() == '/' ? '/?' : '?';

        return count($request->query()) > 0
            ? $request->url() . $question . http_build_query($query)
            : $request->fullUrl();
    }
}
