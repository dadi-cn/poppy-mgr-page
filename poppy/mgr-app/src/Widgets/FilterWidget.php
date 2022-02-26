<?php

namespace Poppy\MgrApp\Widgets;

use Closure;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Form\FormItem;
use Poppy\MgrApp\Grid\Filter\FilterDef;
use Poppy\MgrApp\Grid\Filter\Presenter\Between as BetweenPresenter;
use Poppy\MgrApp\Grid\Filter\Presenter\DateTime;
use Poppy\MgrApp\Grid\Filter\Render\Between;
use Poppy\MgrApp\Grid\Filter\Render\BetweenDate;
use Poppy\MgrApp\Grid\Filter\Render\Date;
use Poppy\MgrApp\Grid\Filter\Render\EndsWith;
use Poppy\MgrApp\Grid\Filter\Render\Equal;
use Poppy\MgrApp\Grid\Filter\Render\FilterItem;
use Poppy\MgrApp\Grid\Filter\Render\Group;
use Poppy\MgrApp\Grid\Filter\Render\Gt;
use Poppy\MgrApp\Grid\Filter\Render\In;
use Poppy\MgrApp\Grid\Filter\Render\Like;
use Poppy\MgrApp\Grid\Filter\Render\Lt;
use Poppy\MgrApp\Grid\Filter\Render\Month;
use Poppy\MgrApp\Grid\Filter\Render\NotEqual;
use Poppy\MgrApp\Grid\Filter\Render\NotIn;
use Poppy\MgrApp\Grid\Filter\Render\Scope;
use Poppy\MgrApp\Grid\Filter\Render\StartsWith;
use Poppy\MgrApp\Grid\Filter\Render\Where;
use Poppy\MgrApp\Grid\Filter\Render\Year;
use Poppy\MgrApp\Grid\Model;
use ReflectionException;

/**
 * @method Where where(Closure $query, $label = '', $column = null) 自定义查询条件
 * @method Equal equal($column, $label = '') 相等
 * @method NotEqual notEqual($column, $label = '') 不等
 * @method Like like($column, $label = '') 匹配搜索
 * @method StartsWith startsWith($column, $label = '') 前半部分匹配
 * @method EndsWith endsWith($column, $label = '') 后半部分匹配
 * @method Gt gt($column, $label = '') 大于
 * @method Lt lt($column, $label = '') 小于
 * @method In in($column, $label = '') 包含
 * @method NotIn notIn($column, $label = '') 不包含
 * @method Between between($column, $label = '') 介于...
 * @method BetweenDate betweenDate($column, $label = '') 介于日期之间
 * @method Date date($column, $label = '') 日期
 * @method Month month($column, $label = '') 月份
 * @method Year year($column, $label = '') 年度
 * @method Group group($column, $label = '', $builder = null) 分组
 */
final class FilterWidget
{

    /**
     * 表单内的表单条目集合
     * @var Collection
     */
    protected Collection $items;

    /**
     * 当前的模型
     * @var Model
     */
    protected $model;


    private int  $actionWidth  = 4;

    private bool $enableExport = false;

    /**
     * 全局范围
     * @var Collection
     */
    private Collection $scopes;

    public function __construct(Model $model)
    {
        $this->items = collect();
        $this->model = $model;

        $this->scopes = new Collection();
    }

    /**
     * 添加搜索条件
     * @param FilterItem $item
     * @return $this
     */
    public function addItem(FilterItem $item): self
    {
        $this->items->push($item);
        return $this;
    }

    /**
     * 获取表单的所有字段
     * @return FormItem[]|Collection
     */
    public function items(): Collection
    {
        return $this->items;
    }

    /**
     * Generate items and append to filter list
     * @param string $method    类型
     * @param array  $arguments 传入的参数
     *
     * @return FormItem|$this
     * @throws ApplicationException
     * @throws ReflectionException
     */
    public function __call(string $method, array $arguments = [])
    {
        if ($method === 'where') {
            $filter = new Where(...$arguments);
            return tap($filter, function ($field) {
                $this->addItem($field);
            });
        }
        $name   = (string) Arr::get($arguments, 0);
        $label  = (string) Arr::get($arguments, 1);
        $filter = FilterDef::create($method, $name, $label);
        if (is_null($filter)) {
            throw new ApplicationException("Filter `${method}` not exists");
        }
        if ($filter instanceof Between || $filter instanceof BetweenDate) {
            $filter->setPresenter(new BetweenPresenter());
        }
        if ($filter instanceof Date) {
            $filter->setPresenter((new DateTime())->date());
        }
        if ($filter instanceof Month) {
            $filter->setPresenter((new DateTime())->month());
        }
        if ($filter instanceof Year) {
            $filter->setPresenter((new DateTime())->year());
        }
        return tap($filter, function ($field) {
            $this->addItem($field);
        });
    }

    /**
     * Execute the filter with conditions.
     *
     * @return Collection
     * @throws Exception
     */
    public function execute(): Collection
    {
        $conditions = array_merge(
            $this->conditions(),
            $this->scopeConditions()
        );
        return $this->model->addConditions($conditions)->buildData();
    }


    /**
     * 返回结构
     * 规则解析参考 : https://github.com/yiminghe/async-validator
     */
    public function struct(): array
    {
        $items = new Collection();
        $this->items->each(function (FilterItem $item) use ($items) {
            $struct = $item->struct();
            $items->push($struct);
        });
        return [
            'action' => [
                'width'  => $this->actionWidth,
                'export' => $this->enableExport
            ],
            'items'  => $items->toArray(),
        ];
    }

    /**
     * 按钮的宽度(默认 4), 这里不会处理按钮的位置
     * @param int  $width  宽度
     * @param bool $export 是否允许导出
     * @return void
     */
    public function action(int $width = 3, bool $export = false)
    {
        $this->actionWidth  = $width;
        $this->enableExport = $export;
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

        if (empty($inputs)) {
            return [];
        }

        $params = [];

        foreach ($inputs as $key => $value) {
            Arr::set($params, $key, $value);
        }

        $conditions = [];
        foreach ($this->items as $filter) {
            $conditions[] = $filter->condition($params);
        }

        return array_filter($conditions);
    }


    /**
     * 添加全局范围
     * @param string $key
     * @param string $label
     *
     * @return mixed
     */
    public function scope(string $key, string $label)
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
     * Get scope conditions.
     *
     * @return array
     */
    private function scopeConditions(): array
    {
        if ($scope = $this->getCurrentScope()) {
            return $scope->condition();
        }

        return [];
    }

    /**
     * Get current scope.
     *
     * @return Scope|null
     */
    private function getCurrentScope(): ?Scope
    {
        $key = request(Scope::QUERY_NAME);
        return $this->scopes->first(function ($scope) use ($key) {
            return $scope->value == $key;
        });
    }
}
