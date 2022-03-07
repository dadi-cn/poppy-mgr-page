<?php

namespace Poppy\MgrApp\Classes\Widgets;

use Closure;
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
use Poppy\MgrApp\Classes\Grid\Concerns\HasSelector;
use Poppy\MgrApp\Classes\Grid\Concerns\HasTotalRow;
use Poppy\MgrApp\Classes\Grid\Model;
use Poppy\MgrApp\Classes\Grid\Row;
use Poppy\MgrApp\Classes\Grid\Tools\Actions;
use Poppy\MgrApp\Http\Grid\GridBase;
use Throwable;
use function collect;
use function input;
use function request;
use function url;

class GridWidget
{
    use PoppyTrait;
    use
        HasExport,
        HasFilter,
        HasTotalRow,
        HasSelector,
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
    protected $columns;

    /**
     * 数据行
     * @var Collection
     */
    protected $rows;

    /**
     * Rows callable function.
     *
     * @var Closure
     */
    protected $rowsCallback;

    /**
     * Grid builder.
     *
     * @var Closure
     */
    protected $builder;

    /**
     * All variables in grid view.
     *
     * @var array
     */
    protected $variables = [];

    /**
     * Default primary key name.
     *
     * @var string
     */
    protected string $keyName = 'id';

    /**
     * @var []callable
     */
    protected $renderingCallbacks = [];

    /**
     * Options for grid.
     *
     * @var array
     */
    protected $options = [
        'show_tools'    => true,
        'show_exporter' => false
    ];

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
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct($model)
    {
        $this->model   = new Model($model, $this);
        $this->keyName = $model->getKeyName();

        $this->initialize();

        $this->handleExportRequest();

        $this->callInitCallbacks();
    }

    /**
     * Get Grid model.
     *
     * @return Model
     */
    public function model()
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
     * Get or set option for grid.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return $this|mixed
     */
    public function option(string $key, $value = null)
    {
        if (is_null($value)) {
            return $this->options[$key];
        }
        $this->options[$key] = $value;
        return $this;
    }

    /**
     * 获取模型的主键
     * @return string
     */
    public function getKeyName(): string
    {
        return $this->keyName;
    }

    /**
     * 进行分页
     * @param int $pagesize
     * @return void
     */
    public function setPagesize(int $pagesize = 15)
    {
        $this->pagesize = $pagesize;
        $this->model()->setPagesize($pagesize);
    }

    /**
     * Get the grid paginator.
     *
     * @return mixed
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

    /**
     * Get current resource url.
     * @return string
     */
    public function resource(): string
    {
        return url(app('request')->getPathInfo());
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
        $this->handleExportRequest(true);

        if (input('_query')) {
            return $this->inquire();
        }
        if (input('_edit')) {
            return $this->edit();
        }

        $this->callRenderingCallback();

        return $this->skeleton();
    }

    public function skeleton()
    {
        $columns = [];
        collect($this->visibleColumns())->each(function (Column $column) use (&$columns) {
            $defines = [
                'field'    => $this->convertFieldName($column->name),
                'label'    => $column->label,
                'type'     => $column->type,
                'sortable' => $column->sortable,
                'ellipsis' => $column->ellipsis,
            ];

            if ($width = $column->width) {
                $defines += ['width' => $width];
            }
            if ($fixed = $column->fixed) {
                $defines += ['fixed' => $fixed];
            }
            if ($column->editable) {
                $defines += ['edit' => 'text'];
            }
            $columns[] = $defines;
        });
        return Resp::success('Grid Skeleton', [
            'type'    => 'grid',
            'url'     => $this->pyRequest()->url(),
            'title'   => $this->title ?: '-',
            'actions' => $this->quickActions->struct(),
            'batch'   => $this->batchActions->struct(),
            'filter'  => $this->filter->struct(),
            'scopes'  => $this->getFilter()->getScopesStruct(),
            'options' => [
                'page_sizes' => $this->pagesizeOptions,
            ],
            'cols'    => $columns,
            'pk'      => $this->model()->getOriginalModel()->getKeyName(),
        ]);
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
     * Initialize.
     */
    protected function initialize()
    {
        $this->columns = Collection::make();
        $this->rows    = Collection::make();
        $this->initFilter();
        $this->quickActions = new Actions();
        $this->batchActions = new Actions();
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
     * Build the grid rows.
     *
     * @param array $data
     *
     * @return void
     */
    protected function buildRows(array $data)
    {
        $this->rows = collect($data)->map(function ($model, $number) {
            return new Row($number, $model, $this->keyName);
        });

        if ($this->rowsCallback) {
            $this->rows->map($this->rowsCallback);
        }
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

    private function edit()
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
     * @return Response|JsonResponse|RedirectResponse|Resp
     * @throws Exception
     */
    private function inquire()
    {
        // 获取模型数据
        $collection = $this->applyQuery();

        Column::setOriginalGridModels($collection);

        $data = $collection->toArray();
        $this->columns->map(function (Column $column) use (&$data) {
            $data = $column->fill($data);

            $this->columnNames[] = $column->name;
        });

        $this->buildRows($data);

        $rows = [];
        foreach ($this->rows as $row) {
            $item = [];
            foreach ($this->visibleColumnNames() as $name) {
                $item[$this->convertFieldName($name)] = $row->column($name);
            }
            $rows[] = $item;
        }

        $paginator = $this->paginator();

        return Resp::success('获取成功', [
            'list'  => $rows,
            'total' => $paginator->total(),
        ]);
    }


    private function convertFieldName($name)
    {
        return str_replace('.', '-', $name);
    }
}
