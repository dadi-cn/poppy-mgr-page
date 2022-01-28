<?php

namespace Poppy\MgrApp\Widgets;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Classes\Traits\PoppyTrait;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Framework\Http\Pagination\PageInfo;
use Poppy\MgrApp\Grid\Column;
use Poppy\MgrApp\Grid\Concerns;
use Poppy\MgrApp\Grid\Filter\Scope;
use Poppy\MgrApp\Grid\Model;
use Poppy\MgrApp\Grid\Row;
use Poppy\MgrApp\Http\Lists\ListBase;
use Response;
use Throwable;

class GridWidget
{
    use PoppyTrait;
    use Concerns\HasElementNames,
        Concerns\HasExport,
        Concerns\HasFilter,
        Concerns\HasTools,
        Concerns\HasTotalRow,
        Concerns\HasActions,
        Concerns\HasSelector,
        Concerns\CanHidesColumns,
        Concerns\HasQuickButton;

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
     * Per-page options.
     *
     * @var array
     */
    public array $perPages = [15, 30, 50, 100, 200];

    /**
     * 默认分页数
     * @var int
     */
    public int $pagesize = 15;

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
     * Mark if the grid is builded.
     *
     * @var bool
     */
    protected $isBuild = false;

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
    protected $keyName = 'id';

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
        'show_tools'        => true,
        'show_exporter'     => false,
        'show_row_selector' => true,
    ];

    /**
     * Create a new grid instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param Closure|null                        $builder
     */
    public function __construct($model, Closure $builder = null)
    {
        $this->model   = new Model($model, $this);
        $this->keyName = $model->getKeyName();
        $this->builder = $builder;

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
     * @param string $field
     * @param string $order
     * @throws ApplicationException
     */
    public function setLists(string $grid_class, $field = '', $order = 'desc')
    {
        if (!class_exists($grid_class)) {
            throw new ApplicationException('Grid Class `' . $grid_class . '` Not Exists.');
        }

        /** @var ListBase $List */
        $List = new $grid_class($this);
        if ($title = $List->title) {
            $this->setTitle($title);
        }
        $List->columns();
        $List->actions();
        $this->columns = $List->getColumns();
        if (is_callable([$this->model(), 'orderBy'])
            &&
            (($pk = $this->model()->getOriginalModel()->getKeyName()) || $field)
            &&
            $order
        ) {
            $order = input('_order') ?: $order;
            $this->model()->orderBy(
                input('_field', $field ?: $pk),
                $order
            );
        }

        $this->filter($List->filter());
        $this->appendQuickButton($List->quickButtons());
        $this->batchActions($List->batchAction());
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
     * Get primary key name of model.
     *
     * @return string
     */
    public function getKeyName(): string
    {
        return $this->keyName ?: 'id';
    }

    /**
     * Paginate the grid.
     *
     * @param int $perPage
     *
     * @return void
     */
    public function paginate($perPage = 15)
    {
        $this->pagesize = $perPage;

        $this->model()->setPerPage($perPage);
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
     * 设置分页的可选条目数
     *
     * @param array $perPages
     */
    public function perPages(array $perPages)
    {
        $this->perPages = $perPages;
    }

    /**
     * Disable row selector.
     *
     * @param bool $disable
     * @return GridWidget|mixed
     */
    public function disableRowSelector(bool $disable = true): self
    {
        return $this->disableBatchActions($disable);
    }

    /**
     * Build the grid.
     *
     * @return void
     */
    public function build()
    {
        if ($this->isBuild) {
            return;
        }

        $this->addDefaultColumns();

        $this->isBuild = true;
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
     * Add variables to grid view.
     *
     * @param array $variables
     *
     * @return $this
     */
    public function with($variables = []): self
    {
        $this->variables = $variables;

        return $this;
    }


    /**
     * Set grid title.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->variables['title'] = $title;

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
     * @return string
     * @throws Throwable
     */
    public function resp()
    {
        $this->handleExportRequest(true);

        if (input('_query')) {
            return $this->inquire(PageInfo::pagesize());
        }
        if (input('_edit')) {
            return $this->edit();
        }

        $this->build();

        $this->callRenderingCallback();

        return $this->skeleton();
    }

    public function skeleton()
    {
        $columns = [];
        collect($this->visibleColumns())->each(function (Column $column) use (&$columns) {
            $defines = [
                'field' => $this->convertFieldName($column->name),
                'label' => $column->label,
                'sort'  => $column->sortable,
                'style' => $column->style,
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
        $scopes = $this->getFilter()->getScopes()->map(function (Scope $scope) {
            return [
                'key'   => $scope->key,
                'label' => $scope->getLabel(),
            ];
        });
        return Resp::success('Grid Skeleton', [
            'type'         => 'grid',
            'url'          => $this->pyRequest()->url(),
            'title'        => $this->variables['title'],
            'actions'      => $this->skeletonQuickButton(),
            'filter'       => $this->getFilter()->renderSkeleton(),
            'scopes'       => $scopes,
            'page-options' => $this->perPages,
            'pagesize'     => $this->pagesize,
            'cols'         => $columns,
            'pk'           => $this->model()->getOriginalModel()->getKeyName(),
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

        $this->initTools($this);
        $this->initFilter();
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
     * 添加多选框列
     *
     * @return void
     */
    protected function prependRowSelectorColumn()
    {
        if (!$this->option('show_row_selector')) {
            return;
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
     * @return array|Collection|mixed
     */
    protected function applyQuery()
    {
        $this->applyQuickSearch();

        $this->applyColumnFilter();

        $this->applyColumnSearch();

        $this->applySelectorQuery();

        return $this->applyFilter(false);
    }

    /**
     * 添加多选 / 操作项目
     * @return void
     */
    protected function addDefaultColumns()
    {
        $this->prependRowSelectorColumn();
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
     * @param int $pagesize
     * @return array|JsonResponse|RedirectResponse|\Illuminate\Http\Response|Redirector|Resp|Response
     */
    private function inquire($pagesize = 15)
    {
        $this->paginate($pagesize);
        /**
         * 获取到的模型数据
         */
        $collection = $this->applyQuery();

        $this->build();

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
            'list'       => $rows,
            'pagination' => [
                'total' => $paginator->total(),
                'page'  => $paginator->currentPage(),
                'size'  => $paginator->perPage(),
                'pages' => $paginator->lastPage(),
            ],
        ]);
    }


    private function convertFieldName($name)
    {
        return str_replace('.', '-', $name);
    }
}
