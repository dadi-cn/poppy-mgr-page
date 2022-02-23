<?php

namespace Poppy\MgrApp\Grid\Filter\Render;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Poppy\Framework\Helper\StrHelper;
use Poppy\MgrApp\Grid\Filter\Presenter\DateTime;
use Poppy\MgrApp\Grid\Filter\Presenter\MultiSelect;
use Poppy\MgrApp\Grid\Filter\Presenter\Presenter;
use Poppy\MgrApp\Grid\Filter\Presenter\Select;
use Poppy\MgrApp\Grid\Filter\Presenter\Text;

/**
 * Text
 * @method Text placeholder($placeholder = '') 占位符
 */
abstract class AbstractFilterItem extends FilterItem
{

    /**
     * @var Collection
     */
    public $group;

    /**
     * Label of presenter.
     *
     * @var string
     */
    protected $label;

    /**
     * @var array|string
     */
    protected $value;

    /**
     * @var array|string
     */
    protected $defaultValue;

    /**
     * @var string
     */
    protected $column;

    /**
     * Presenter object.
     *
     * @var Presenter
     */
    protected Presenter $presenter;

    /**
     * Query for filter.
     * @var string
     */
    protected string $query = 'where';

    /**
     * @var FilterItem
     */
    protected $parent;

    /**
     * AbstractFilter constructor.
     *
     * @param string $column
     * @param string $label
     */
    public function __construct(string $column = '', string $label = '')
    {
        $this->column = $column;
        $this->label  = $this->formatLabel($label);
        $this->setupDefaultPresenter();
    }

    /**
     * @param FilterItem $filter
     */
    public function setParent(FilterItem $filter)
    {
        $this->parent = $filter;
    }

    /**
     * 获取查询条件
     * @param array $inputs
     *
     * @return array|mixed|null
     */
    public function condition(array $inputs)
    {
        $value = Arr::get($inputs, $this->column);

        if (!isset($value)) {
            return null;
        }

        $this->value = $value;

        return $this->buildCondition($this->column, $this->value);
    }

    /**
     * 选择不支持跨度查询
     * @param array|Collection $options
     * @return Select
     */
    public function select($options = [], $placeholder = '')
    {
        return $this->setPresenter((new Select())->options($options)->placeholder($placeholder));
    }

    /**
     * 多选不支持跨度查询
     * @param array|Collection $options
     * @return MultiSelect
     */
    public function multipleSelect($options = [], $placeholder = '')
    {
        return $this->setPresenter((new MultiSelect())->options($options)->placeholder($placeholder));
    }

    /**
     * 日期时间
     * @return DateTime
     */
    public function datetime($placeholder = '')
    {
        return $this->setPresenter((new DateTime())->datetime($placeholder));
    }

    /**
     * 文本渲染
     * @param string|array $placeholder
     * @return Text
     */
    public function text($placeholder = '')
    {
        return $this->setPresenter((new Text())->placeholder($placeholder));
    }

    /**
     * Date filter.
     *
     * @return DateTime
     */
    public function date($placeholder = '')
    {
        return $this->setPresenter((new DateTime())->date($placeholder));
    }

    /**
     * Month filter.
     *
     * @return DateTime
     */
    public function month($placeholder = '')
    {
        return $this->setPresenter((new DateTime())->month($placeholder));
    }

    /**
     * 年份查询/年份渲染不支持跨年查询
     * @return DateTime
     */
    public function year($placeholder = '')
    {
        return $this->setPresenter((new DateTime())->year($placeholder));
    }

    public function struct(): array
    {
        $explain = Str::snake(Str::afterLast(get_called_class(), '\\'));
        return array_merge([
            'name'    => StrHelper::formatId($this->column),
            'label'   => $this->label,
            'width'   => $this->width,
            'value'   => $this->value ?: $this->defaultValue,
            'type'    => $this->presenter->type(),
            'explain' => $explain,
            'options' => $this->presenter->toArray()
        ]);
    }

    /**
     * 表现
     * @param string       $method
     * @param array|string $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call(string $method, $arguments)
    {
        if (method_exists($this->presenter, $method)) {
            return $this->presenter()->{$method}(...$arguments);
        }

        throw new Exception('Presenter Method "' . $method . '" not exists.');
    }

    /**
     * Time filter.
     *
     * @return DateTime
     */
    public function time()
    {
        return $this->datetime(['layui-type' => 'time']);
    }

    /**
     * Set default value for filter.
     *
     * @param null $default
     *
     * @return $this
     */
    public function default($default = null)
    {
        if ($default) {
            $this->defaultValue = $default;
        }

        return $this;
    }

    /**
     * Get column name of current filter.
     *
     * @return string
     */
    public function getColumn()
    {
        $parentName = $this->parent->name;

        return $parentName ? "{$parentName}_{$this->column}" : $this->column;
    }

    /**
     * Get value of current filter.
     *
     * @return array|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set presenter object of filter.
     *
     * @param Presenter $presenter
     *
     * @return mixed
     */
    public function setPresenter(Presenter $presenter)
    {
        $presenter->setParent($this);

        return $this->presenter = $presenter;
    }

    /**
     * Setup default presenter.
     *
     * @return void
     */
    protected function setupDefaultPresenter()
    {
        $this->setPresenter(new Text());
    }

    /**
     * 格式化 Label
     * @param string $label
     * @return string
     */
    protected function formatLabel(string $label): string
    {
        $label = $label ?: ucfirst($this->column);
        return str_replace(['.', '_'], ' ', $label);
    }


    /**
     * Get presenter object of filter.
     * @return Presenter
     */
    protected function presenter(): Presenter
    {
        return $this->presenter;
    }

    /**
     * Build conditions of filter.
     *
     * @return mixed
     */
    protected function buildCondition(): array
    {
        $column = explode('.', $this->column);

        if (count($column) == 1) {
            // where ['title', 'like', '%我%']
            return [$this->query => func_get_args()];
        }

        return $this->buildRelationQuery(...func_get_args());
    }

    /**
     * Build query condition of model relation.
     *
     * @return array
     */
    protected function buildRelationQuery(): array
    {
        $args = func_get_args();

        [$relation, $args[0]] = explode('.', $this->column);

        return [
            'whereHas' => [
                $relation, function ($relation) use ($args) {
                    call_user_func_array([$relation, $this->query], $args);
                },
            ],
        ];
    }
}
