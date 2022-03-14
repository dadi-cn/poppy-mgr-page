<?php

namespace Poppy\MgrApp\Classes\Widgets;

use Closure;
use Eloquent;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Classes\Traits\PoppyTrait;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Grid\Column\Column;
use Poppy\MgrApp\Classes\Grid\Concerns\CanHidesColumns;
use Poppy\MgrApp\Classes\Grid\Concerns\HasExport;
use Poppy\MgrApp\Classes\Grid\Concerns\HasFilter;
use Poppy\MgrApp\Classes\Grid\Concerns\HasPaginator;
use Poppy\MgrApp\Classes\Grid\Concerns\HasSelection;
use Poppy\MgrApp\Classes\Grid\Concerns\HasTotalRow;
use Poppy\MgrApp\Classes\Grid\Model;
use Poppy\MgrApp\Classes\Grid\Row;
use Poppy\MgrApp\Classes\Grid\Tools\Actions;
use Poppy\MgrApp\Classes\Traits\UseColumn;
use Poppy\MgrApp\Classes\Traits\UseWidgetUtil;
use Poppy\MgrApp\Http\Grid\GridBase;
use Throwable;
use function collect;
use function input;
use function request;

/**
 * @property-read string $title 标题
 */
class GridWidget
{
    use PoppyTrait;
    use UseColumn;
    use UseWidgetUtil;
    use
        HasExport,
        HasFilter,
        HasTotalRow,
        HasSelection,
        HasPaginator,
        CanHidesColumns;

    /**
     * 排序标识
     */
    public const SORT_NAME = '_sort';

    /**
     * 分页标识
     */
    public const PAGESIZE_NAME = 'pagesize';


    /**
     * Initialization closure array.
     *
     * @var []Closure
     */
    protected static $initCallbacks = [];

    /**
     * All column names of the grid.
     *
     * @var array
     */
    public array $columnNames = [];

    /**
     * 分页工具
     * @var LengthAwarePaginator|null
     */
    protected ?LengthAwarePaginator $paginator = null;

    /**
     * 列表模型实例
     *
     * @var Model
     */
    protected $model;

    /**
     * 所有列的定义
     * @var Collection
     */
    protected Collection $columns;

    /**
     * 数据行
     * @var Collection
     */
    protected Collection $rows;

    /**
     * 所有行的回调
     * @var ?Closure
     */
    protected ?Closure $rowsCallback = null;

    /**
     * All variables in grid view.
     *
     * @var array
     */
    protected $variables = [];

    /**
     * 默认主键的名称
     * @var string
     */
    protected string $pkName = 'id';

    /**
     * @var array|callable[]
     */
    protected array $renderingCallbacks = [];

    /**
     * 右上角快捷操作
     * @var Actions
     */
    private Actions $quickActions;

    /**
     * 左下角快捷操作
     * @var Actions
     */
    private Actions $batchActions;

    /**
     * 标题
     * @var string
     */
    private string $title = '';

    /**
     * Create a new grid instance.
     *
     * @param \Illuminate\Database\Eloquent\Model|Eloquent $model
     */
    public function __construct($model)
    {
        $this->model  = new Model($model, $this);
        $this->pkName = $model->getKeyName();

        $this->initialize();

        $this->callInitCallbacks();
    }


    public function __get($attr)
    {
        return $this->{$attr} ?? '';
    }

    /**
     * 获取模型
     * @return Model
     */
    public function model(): Model
    {
        return $this->model;
    }

    /**
     * @param string $grid_class
     * @throws ApplicationException
     */
    public function setLists(string $grid_class)
    {
        if (!class_exists($grid_class)) {
            throw new ApplicationException('Grid Class `' . $grid_class . '` Not Exists.');
        }

        /** @var GridBase $List */
        $List = new $grid_class($this);


        /* 设置标题和描述
         * ---------------------------------------- */
        $this->title = $List->title;
        $List->columns();
        $List->quickActions($this->quickActions);
        $this->columns = $List->getColumns();
        $List->filter($this->filter);
        $List->batchActions($this->batchActions);
    }

    /**
     * 获取模型的主键
     * @return string
     */
    public function getPkName(): string
    {
        return $this->pkName;
    }


    /**
     * 获取分页工具
     */
    public function paginator()
    {
        $this->paginator = $this->model()->eloquent();

        if ($this->paginator instanceof LengthAwarePaginator) {
            $this->paginator->appends(request()->all());
        }
        return $this->paginator;
    }


    /**
     * Set grid row callback function.
     *
     * @param Closure|null $callable
     */
    public function rows(Closure $callable = null)
    {
        $this->rowsCallback = $callable;
    }


    public function getRows(): Collection
    {
        return $this->rows;
    }

    /**
     * 设置标题
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set rendering callback.
     *
     * @param callable $callback
     *
     * @return $this
     */
    public function rendering(callable $callback): self
    {
        $this->renderingCallbacks[] = $callback;

        return $this;
    }

    /**
     * 返回相应
     *
     * @return JsonResponse|RedirectResponse|Resp|Response
     * @throws Throwable
     */
    public function resp()
    {
        if ($this->queryHas('export')) {
            $type = $this->queryAfter('export');
            $this->queryExport($type);
        }

        if ($this->queryHas('edit')) {
            return $this->queryEdit();
        }

        $resp = [];
        if ($this->queryHas('data')) {
            $resp = array_merge($resp, $this->queryData());
            $this->callRenderingCallback();
        }
        if ($this->queryHas('struct')) {
            $resp = array_merge($resp, $this->queryStruct());
            $resp = array_merge($resp, $this->queryFilter());
        }
        if ($this->queryHas('filter')) {
            $resp = array_merge($resp, $this->queryFilter());
        }

        return Resp::success(input('_query') ?: '', $resp);
    }

    /**
     * Initialize with user pre-defined default disables and exporter, etc.
     *
     * @param Closure|null $callback
     */
    public static function init(Closure $callback = null)
    {
        static::$initCallbacks[] = $callback;
    }

    /**
     * 创建表行, 根据模型查询出来的数据组合返回的数据
     * @param array $data 所有查询出来的数据
     * @return void
     */
    public function buildRows(array $data)
    {
        $this->rows = collect($data)->map(function ($model, $number) use ($data) {
            return new Row($number, $model, $this->pkName);
        });

        if ($this->rowsCallback) {
            $this->rows->map($this->rowsCallback);
        }
    }

    /**
     * Initialize.
     */
    protected function initialize()
    {
        $this->columns = Collection::make();
        $this->rows    = Collection::make();
        $this->initFilter();
        $this->quickActions = (new Actions())->default(['primary', 'plain']);
        $this->batchActions = (new Actions())->default(['info', 'plain']);
    }

    /**
     * Call the initialization closure array in sequence.
     */
    protected function callInitCallbacks()
    {
        if (empty(static::$initCallbacks)) {
            return;
        }

        foreach (static::$initCallbacks as $callback) {
            call_user_func($callback, $this);
        }
    }

    /**
     * Apply column filter to grid query.
     *
     * @return void
     */
    protected function applyColumnFilter()
    {
        $this->columns->each(function (Column $column) {
            $column->bindFilterQuery($this->model());
        });
    }

    /**
     * Apply column search to grid query.
     *
     * @return void
     */
    protected function applyColumnSearch()
    {
        $this->columns->each(function (Column $column) {
            $column->bindSearchQuery($this->model());
        });
    }

    /**
     * @return Collection
     * @throws Exception
     */
    protected function applyQuery(): Collection
    {
        //        $this->applyQuickSearch();
        //
        //        $this->applyColumnFilter();
        //
        //        $this->applyColumnSearch();
        //
        //        $this->applySelectorQuery();

        return $this->applyFilter();
    }

    /**
     * Call callbacks before render.
     *
     * @return void
     */
    protected function callRenderingCallback()
    {
        foreach ($this->renderingCallbacks as $callback) {
            call_user_func($callback, $this);
        }
    }

    private function queryStruct(): array
    {
        $columns = [];
        collect($this->visibleColumns())->each(function (Column $column) use (&$columns) {
            $columns[] = $column->struct();
        });

        // if batchAction => selection True
        // if exportable => selection True
        // if selection & !pk => Selection Disable
        // 支持批处理, 开启选择器
        if (count($this->batchActions->struct())) {
            $this->enableSelection();
        }
        if ($this->filter->getEnableExport()) {
            $this->enableSelection();
        }

        return [
            'type'    => 'grid',
            'url'     => $this->pyRequest()->url(),
            'title'   => $this->title ?: '-',
            'batch'   => $this->batchActions->struct(),
            'scopes'  => $this->getFilter()->getScopesStruct(),
            'scope'   => $this->getFilter()->getCurrentScope() ? $this->getFilter()->getCurrentScope()->value : '',
            'options' => [
                'page_sizes' => $this->pagesizeOptions,
                'selection'  => $this->selectionEnable,
            ],
            'cols'    => $columns,
            'pk'      => $this->model()->getOriginalModel()->getKeyName(),
        ];
    }

    private function queryFilter(): array
    {
        $columns = [];
        collect($this->visibleColumns())->each(function (Column $column) use (&$columns) {
            $columns[] = $column->struct();
        });
        return [
            'actions' => $this->quickActions->struct(),
            'filter'  => $this->filter->struct(),
        ];
    }

    private function queryEdit()
    {
        $pk    = input('_pk');
        $field = input('_field');
        $value = input('_value');
        if (!$this->model->edit($pk, $field, $value)) {
            return Resp::error('修改失败');
        }
        return Resp::success('修改成功');
    }

    /**
     * 查询并返回数据
     * @throws Exception
     */
    private function queryData(): array
    {
        // 获取模型数据
        $collection = $this->applyQuery();

        Column::setOriginalGridModels($collection);

        $data = $collection->toArray();
        $this->visibleColumns()->map(function (Column $column) use (&$data) {
            $data = $column->fill($data);
        });

        $this->buildRows($data);

        $rows = [];
        foreach ($this->rows as $row) {
            /** @var Row $row */
            $item = [];
            foreach ($this->getVisibleColumnsName() as $name) {
                $item[$this->convertFieldName($name)] = $row->column($name);
            }
            $rows[] = $item;
        }

        $paginator = $this->paginator();

        return [
            'list'  => $rows,
            'total' => $paginator->total(),
        ];
    }
}
