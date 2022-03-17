<?php

namespace Poppy\MgrApp\Classes\Contracts;

use Closure;
use Illuminate\Support\Collection;
use Poppy\MgrApp\Classes\Grid\Column\Column;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;

interface Query
{

    public function useIds(array $ids = []): self;

    /**
     * 获取查询数据
     */
    public function buildData(): Collection;


    /**
     * 批量返回数据
     * @param Closure $closure
     * @param int     $amount
     * @return mixed
     */
    public function chunk(Closure $closure, int $amount = 100);


    /**
     * 根据查询条件返回当前可用的数据
     * @return int
     */
    public function total(): int;


    /**
     * 数据预处理
     * @param FilterWidget $filter
     * @return $this
     */
    public function prepare(FilterWidget $filter): self;

    /**
     * 对当前查询条件进行编辑
     * @param        $id
     * @param string $field
     * @param        $value
     * @return bool
     */
    public function edit($id, string $field, $value): bool;


    public function usePaginate();


    public function pkName();


    /**
     * 验证并返回定义列
     * @param Collection|Column[] $columns
     * @return Collection
     */
    public function validate(Collection $columns): Collection;
}
