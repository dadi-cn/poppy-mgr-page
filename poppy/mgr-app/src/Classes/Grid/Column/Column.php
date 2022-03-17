<?php

namespace Poppy\MgrApp\Classes\Grid\Column;

use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Poppy\Framework\Helper\UtilHelper;
use Poppy\MgrApp\Classes\Contracts\Structable;
use Poppy\MgrApp\Classes\Grid\Column\Render\ActionsRender;
use Poppy\MgrApp\Classes\Grid\Column\Render\DownloadRender;
use Poppy\MgrApp\Classes\Grid\Column\Render\HtmlRender;
use Poppy\MgrApp\Classes\Grid\Column\Render\ImageRender;
use Poppy\MgrApp\Classes\Grid\Column\Render\LinkRender;
use Poppy\MgrApp\Classes\Grid\Column\Render\Render;
use Poppy\MgrApp\Classes\Grid\Model;
use Poppy\MgrApp\Classes\Traits\UseColumn;
use Poppy\MgrApp\Classes\Widgets\GridWidget;
use function request;

/**
 * 列展示以及渲染, 当前的目的是使用前端方式渲染, 而不是依靠于 v-html 或者是后端生成
 * @property-read string $name    当前列的名称
 * @property-read string $label   标签
 * @method Column image($server = '', $width = 200, $height = 200)
 * @method Column link($href = '', $target = '_blank')
 * @method Column download($server = '')
 */
class Column implements Structable
{
    use HasHeader, UseColumn;

    public const NAME_BATCH  = '_batch';      // 批量选择 / 导出的主键约定, pk 会和搜索冲突
    public const NAME_COLS   = '_cols';       // 支持用户选择进行查询的列定义
    public const NAME_ACTION = '_action';     // 用于定义列操作, 可以在导出时候移除

    /**
     * Displayer for grid column.
     *
     * @var array
     */
    public static array $renderers = [
        'html'     => HtmlRender::class,
        'image'    => ImageRender::class,
        'link'     => LinkRender::class,
        'download' => DownloadRender::class,
    ];

    /**
     * Defined columns.
     *
     * @var array
     */
    public static $defined = [];

    /**
     * @var array
     */
    protected static $rowAttributes = [];

    /**
     * @var GridWidget
     */
    protected $grid;

    /**
     * 列名称
     * @var string
     */
    protected string $name;

    /**
     * Label of column.
     *
     * @var string
     */
    protected $label;

    /**
     * Original value of column.
     *
     * @var mixed
     */
    protected $original;

    /**
     * Relation name.
     *
     * @var bool
     */
    protected $relation = false;

    /**
     * Relation column.
     *
     * @var string
     */
    protected $relationColumn;

    /**
     * @var []Closure
     */
    protected $displayCallbacks = [];

    /**
     * @var bool 是否启用排序
     */
    protected bool $sortable = false;

    /**
     * @var bool 是否进行文字隐藏展示
     */
    protected bool $ellipsis = false;

    /**
     * 可复制的
     * @var bool
     */
    protected bool $copyable = false;

    /**
     * todo 可搜索的
     * @var bool
     */
    protected bool $searchable = false;

    /**
     * 定义宽度
     * @var int
     */
    protected int $width = 0;

    /**
     * 对齐方式
     * @var string
     */
    protected string $align = '';

    /**
     * 渲染类型
     * @var string
     */
    private string $type = 'text';

    /**
     * todo 可编辑的
     * @var bool
     */
    private bool $editable = false;

    /**
     * 列固定
     * @var string
     */
    private string $fixed = '';

    /**
     * 最小宽度
     * @var int
     */
    private int $minWidth = 150;

    /**
     * @param string $name
     * @param string $label
     */
    public function __construct(string $name, string $label = '')
    {
        $this->name  = $name;
        $this->label = $label ?: ucfirst($name);
    }

    /**
     * Set grid instance for column.
     *
     * @param GridWidget $grid
     */
    public function setGrid(GridWidget $grid)
    {
        $this->grid = $grid;
    }

    public function editable(): self
    {
        $this->editable = true;
        return $this;
    }

    /**
     * 渲染为ID
     * @return $this
     */
    public function quickId($large = false): self
    {
        $width = $large ? 110 : 90;
        $this->width($width, true)->align('center');
        return $this;
    }

    /**
     * 渲染为标题, 默认显示 15个汉字, large 模式显示 20个汉字左右
     * @return $this
     */
    public function quickTitle($large = false): self
    {
        $width = $large ? 320 : 250;
        $this->ellipsis()->width($width, true)->copyable();
        return $this;
    }

    /**
     * 渲染为 Datetime 时间
     * @return $this
     */
    public function quickDatetime(): self
    {
        $this->width(170, true)->align('center');
        return $this;
    }

    /**
     * 定义快捷样式
     * @return $this
     */
    public function quickIcon($num = 3, $fixed = true): self
    {
        $width = 16 + $num * 44;
        $this->width($width, true)->align('center');
        if ($fixed) {
            $this->fixed();
        }
        return $this;
    }

    /**
     * 设置列宽度, 单个按钮 最优宽度 60(图标), 每个按钮增加 45 宽度
     * Datetime 最优宽度 170
     * @param int  $width 宽度
     * @param bool $fixed 是否是固定宽度
     * @return $this
     */
    public function width(int $width, bool $fixed = false): self
    {
        if ($fixed) {
            $this->width = $width;
        } else {
            $this->minWidth = $width;
        }
        return $this;
    }

    /**
     * 设置展示位置, 默认 left, 可选 [left,center,right]
     * @param string|int $align
     * @return $this
     */
    public function align($align): self
    {
        $this->align = $align;
        return $this;
    }

    /**
     * 标识列为可排序
     * @return Column
     */
    public function sortable(): self
    {
        $this->sortable = true;
        return $this;
    }

    /**
     * 隐藏字符展示
     * @return Column
     */
    public function ellipsis(): self
    {
        $this->ellipsis = true;
        return $this;
    }

    /**
     * 可复制
     * @return Column
     */
    public function copyable(): self
    {
        $this->copyable = true;
        return $this;
    }


    /**
     * 标识列为可fix 显示, 默认是右侧, 可以设置为 [left, right]
     * @param string $position
     * @return Column
     */
    public function fixed(string $position = 'right'): self
    {
        $this->fixed = $position;
        return $this;
    }

    /**
     * Set column filter.
     *
     * @param null $builder
     *
     * @return $this
     */
    public function filter($builder = null)
    {
        return $this->addFilter(...func_get_args());
    }


    /**
     * Set column as searchable.
     *
     * @return $this
     */
    public function searchable()
    {
        $this->searchable = true;

        $name  = $this->name;
        $query = request()->query();

        $this->prefix(function ($_, $original) use ($name, $query) {
            Arr::set($query, $name, $original);

            $url = request()->fullUrlWithQuery($query);

            return "<a href=\"{$url}\"><i class=\"fa fa-search\"></i></a>";
        }, '&nbsp;&nbsp;');

        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function struct(): array
    {
        $defines = [
            'field' => $this->convertFieldName($this->name),
            'label' => $this->label,
            'type'  => $this->type,
        ];

        if ($this->sortable) {
            $defines += ['sortable' => 'custom'];
        }
        if ($this->copyable) {
            $defines += ['copyable' => $this->copyable];
        }
        if ($this->ellipsis) {
            $defines += ['ellipsis' => $this->ellipsis];
        }
        if ($this->width) {
            $defines += ['width' => $this->width];
        }
        if ($this->align) {
            $defines += ['align' => $this->align];
        }
        if ($this->minWidth) {
            $defines += ['min-width' => $this->minWidth];
        }
        if ($this->fixed) {
            $defines += ['fixed' => $this->fixed];
        }
        if ($this->editable) {
            $defines += ['edit' => 'text'];
        }
        return $defines;
    }

    /**
     * Bind search query to grid model.
     *
     * @param Model $model
     */
    public function bindSearchQuery(Model $model)
    {
        if (!$this->searchable || !request()->has($this->name)) {
            return;
        }

        $model->where($this->name, request($this->name));
    }

    public function html(Closure $closure): self
    {
        $this->type = 'html';
        return $this->display($closure);
    }

    /**
     * 定义回调
     * @param Closure $callback
     * @return $this
     */
    public function display(Closure $callback): self
    {
        $this->displayCallbacks[] = $callback;
        return $this;
    }


    /**
     * 调用 Actions 预览定义的操作
     * @return $this
     */
    public function actions(Closure $closure): self
    {
        $column = $this;
        return $this->display(function ($value) use ($column, $closure) {
            $render = new ActionsRender($value, $this);
            $column->setType('actions');
            return $render->render($closure);
        });
    }

    /**
     * 使用KV进行替换输出, 并可以指定默认值
     * @param array  $values
     * @param string $default
     * @return $this
     */
    public function usingKv(array $values, string $default = ''): self
    {
        return $this->display(function ($value) use ($values, $default) {
            if (is_null($value)) {
                return $default;
            }

            return Arr::get($values, $value, $default);
        });
    }

    /**
     * 当前列存在, 但是数据暂时隐藏掉
     * @return $this
     */
    public function hide(): self
    {
        $this->grid->hideColumns($this->name);
        return $this;
    }


    /**
     * 显示为友好的文件大小
     * @return $this
     */
    public function filesize(): self
    {
        return $this->display(function ($value) {
            return UtilHelper::formatBytes($value);
        });
    }

    /**
     * 使用 gravatar 来显示头像图
     * @param int $size
     * @return $this
     */
    public function gravatar($size = 25): self
    {
        return $this->display(function ($value) use ($size) {
            $src = sprintf(
                'https://www.gravatar.com/avatar/%s?s=%d',
                md5(strtolower($value)),
                $size
            );
            return "<img src='$src' alt='{$value}' class='img img-circle'/>";
        });
    }

    /**
     * Return a human readable format time.
     *
     * @param null $locale
     *
     * @return $this
     */
    public function diffForHumans($locale = null): self
    {
        if ($locale) {
            Carbon::setLocale($locale);
        }

        return $this->display(function ($value) {
            return Carbon::parse($value)->diffForHumans();
        });
    }

    /**
     * Returns a string formatted according to the given format string.
     *
     * @param string $format
     *
     * @return $this
     */
    public function date(string $format): self
    {
        return $this->display(function ($value) use ($format) {
            return date($format, strtotime($value));
        });
    }

    /**
     * @throws Exception
     */
    public function fillVal($row)
    {
        $this->original = $value = Arr::get($row, $this->name);
        if ($this->isDefinedColumn()) {
            $this->useDefinedColumn();
        }

        if ($this->hasDisplayCallbacks()) {
            $value = $this->callDisplayCallbacks($this->original, $row);
        }
        return $value;
    }

    /**
     * Passes through all unknown calls to builtin displayer or supported displayer.
     *
     * Allow fluent calls on the Column object.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return $this
     */
    public function __call($method, $arguments)
    {
        if ($this->isRelation() && !$this->relationColumn) {
            $this->name  = "{$this->relation}.$method";
            $this->label = ucfirst($arguments[0] ?? null);

            $this->relationColumn = $method;

            return $this;
        }
        return $this->resolveDisplayer($method, $arguments);
    }

    /**
     * 获取类属性
     * @param string $key
     * @return string
     */
    public function __get(string $key)
    {
        return $this->{$key} ?? '';
    }

    /**
     * Extend column displayer.
     *
     * @param $name
     * @param $displayer
     */
    public static function extend($name, $displayer)
    {
        static::$renderers[$name] = $displayer;
    }

    /**
     * 定义全局列渲染
     * @param string $name
     * @param mixed  $definition
     */
    public static function define($name, $definition)
    {
        static::$defined[$name] = $definition;
    }


    /**
     * Get column attributes.
     *
     * @param string $name
     *
     * @return mixed
     */
    public static function getAttributes($name, $key = null)
    {
        $rowAttributes = [];

        if ($key && Arr::has(static::$rowAttributes, "{$name}.{$key}")) {
            $rowAttributes = Arr::get(static::$rowAttributes, "{$name}.{$key}", []);
        }

        return $rowAttributes;
    }

    /**
     * If this column is relation column.
     *
     * @return bool
     */
    protected function isRelation()
    {
        return (bool) $this->relation;
    }

    /**
     * Set relation.
     *
     * @param string $relation
     * @param string $relationColumn
     *
     * @return $this
     */
    public function setRelation($relation, $relationColumn = null)
    {
        $this->relation       = $relation;
        $this->relationColumn = $relationColumn;

        return $this;
    }

    /**
     * If has display callbacks.
     *
     * @return bool
     */
    protected function hasDisplayCallbacks()
    {
        return !empty($this->displayCallbacks);
    }

    /**
     * Call all of the "display" callbacks column.
     *
     * @param mixed $value
     * @param int   $key
     *
     * @return mixed
     */
    protected function callDisplayCallbacks($value, $row)
    {
        foreach ($this->displayCallbacks as $callback) {
            $previous = $value;

            $callback = $callback->bindTo($row);
            $value    = call_user_func_array($callback, [$value, $this]);

            if (($value instanceof static) &&
                ($last = array_pop($this->displayCallbacks))
            ) {
                $last  = $last->bindTo($row);
                $value = call_user_func($last, $previous);
            }
        }

        return $value;
    }

    /**
     * 当前列是否在全局定义中
     * @return bool
     */
    protected function isDefinedColumn(): bool
    {
        return array_key_exists($this->name, static::$defined);
    }

    /**
     * 使用全局列定义
     * @throws Exception
     */
    protected function useDefinedColumn()
    {
        // clear all display callbacks.
        $this->displayCallbacks = [];

        $class = static::$defined[$this->name];

        if ($class instanceof Closure) {
            $this->display($class);
            return;
        }

        if (!class_exists($class) || !is_subclass_of($class, Render::class)) {
            throw new Exception("Invalid column definition [$class]");
        }

        $column = $this;

        $this->display(function ($value) use ($column, $class) {
            /** @var Render $render */
            $render       = new $class($value, $this);
            $column->type = $render->getType();
            return $render->render();
        });
    }

    /**
     * Find a displayer to display column.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return $this
     */
    protected function resolveDisplayer(string $method, array $arguments): self
    {
        $this->type = $method;
        if (array_key_exists($method, static::$renderers)) {
            return $this->callBuiltinDisplayer(static::$renderers[$method], $arguments);
        }
        return $this->callSupportDisplayer($method, $arguments);
    }

    /**
     * Call Illuminate/Support displayer.
     *
     * @param string $method
     * @param array  $arguments
     * @return $this
     */
    protected function callSupportDisplayer(string $method, array $arguments): self
    {
        return $this->display(function ($value) use ($method, $arguments) {
            if (is_array($value) || $value instanceof Arrayable) {
                return call_user_func_array([collect($value), $method], $arguments);
            }

            if (is_string($value)) {
                return call_user_func_array([Str::class, $method], array_merge([$value], $arguments));
            }

            return $value;
        });
    }

    /**
     * Call Builtin displayer.
     *
     * @param string|Closure $abstract
     * @param array          $arguments
     *
     * @return $this
     */
    protected function callBuiltinDisplayer($abstract, array $arguments): self
    {
        if ($abstract instanceof Closure) {
            return $this->display(function ($value) use ($abstract, $arguments) {
                return $abstract->call($this, ...array_merge([$value], $arguments));
            });
        }

        if (class_exists($abstract) && is_subclass_of($abstract, Render::class)) {
            $column = $this;

            return $this->display(function ($value) use ($abstract, $column, $arguments) {
                /** @var Render $render */
                $render       = new $abstract($value, $this);
                $column->type = $render->getType();
                return $render->render(...$arguments);
            });
        }
        return $this;
    }
}
