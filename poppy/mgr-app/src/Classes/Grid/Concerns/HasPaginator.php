<?php

namespace Poppy\MgrApp\Classes\Grid\Concerns;

trait HasPaginator
{
    /**
     * 分页数选项
     * @var array|int[]
     */
    protected array $pagesizeOptions = [
        15, 30, 50, 100, 200
    ];


    /**
     * 分页数
     * @var int
     */
    protected int $pagesize = 15;


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
}
