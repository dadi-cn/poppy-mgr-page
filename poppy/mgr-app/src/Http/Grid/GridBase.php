<?php

namespace Poppy\MgrApp\Http\Grid;

use Closure;
use Poppy\MgrApp\Classes\Grid\Column\Column;
use Poppy\MgrApp\Classes\Grid\Tools\Actions;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Classes\Widgets\TableWidget;
use Poppy\System\Models\PamAccount;

/**
 * @property-read string      $title     标题
 * @property-read TableWidget $table     表格组件
 */
abstract class GridBase implements GridContract
{

    /**
     * 标题
     * @var string
     */
    protected string $title = '';


    /**
     * 列组件
     * @var TableWidget
     */
    protected TableWidget $table;

    /**
     * @var PamAccount
     */
    protected $pam;

    public function __construct()
    {
        $this->pam   = app('auth')->user();
        $this->table = new TableWidget();
    }


    /**
     * 添加列到组件
     * @param string $name
     * @param string $label
     * @return Column
     */
    public function column(string $name, string $label = ''): Column
    {
        return $this->table->add($name, $label);
    }

    /**
     * 添加列操作
     * @param Closure $closure
     * @param string  $title
     * @return Column
     */
    public function action(Closure $closure, string $title = '操作'): Column
    {
        return $this->table->action($closure, $title);
    }


    public function filter(FilterWidget $filter)
    {
    }

    public function quickActions(Actions $actions)
    {
    }

    public function batchActions(Actions $actions)
    {
    }

    public function __get($attr)
    {
        return $this->{$attr} ?? '';
    }
}
