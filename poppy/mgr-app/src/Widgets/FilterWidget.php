<?php

namespace Poppy\MgrApp\Widgets;

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
use Poppy\MgrApp\Grid\Filter\Render\Year;
use Poppy\MgrApp\Grid\Model;

/**
 * @method Equal equal($column, $label = '')
 * @method NotEqual notEqual($column, $label = '')
 * @method Like like($column, $label = '')
 * @method StartsWith startsWith($column, $label = '')
 * @method EndsWith endsWith($column, $label = '')
 * @method Gt gt($column, $label = '')
 * @method Lt lt($column, $label = '')
 * @method In in($column, $label = '')
 * @method NotIn notIn($column, $label = '')
 * @method Between between($column, $label = '')
 * @method BetweenDate betweenDate($column, $label = '')
 * @method Date date($column, $label = '')
 * @method Month month($column, $label = '')
 * @method Year year($column, $label = '')
 * @method Group group($column, $label = '', $builder = null)
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
     */
    public function __call(string $method, array $arguments = [])
    {
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
    public function action(int $width = 4, bool $export = false)
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
     * Get current scope.
     *
     * @return Scope|null
     */
    public function getCurrentScope(): ?Scope
    {
        $key = request(Scope::QUERY_NAME);

        return $this->scopes->first(function ($scope) use ($key) {
            return $scope->key == $key;
        });
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
}
