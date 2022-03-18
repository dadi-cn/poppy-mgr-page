<?php

namespace Poppy\MgrApp\Classes\Grid\Query;

use Closure;
use Illuminate\Support\Collection;
use Poppy\MgrApp\Classes\Contracts\Query;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Classes\Widgets\TableWidget;

class QueryCustom implements Query
{


    /**
     * @return Collection
     */
    public function get(): Collection
    {
        // TODO: Implement get() method.
    }

    /**
     * @param Closure|null $callback
     * @return $this
     */
    public function collection(Closure $callback = null): Query
    {
        // TODO: Implement collection() method.
    }

    /**
     * @param Closure $closure
     * @param int $amount
     * @return mixed
     */
    public function chunk(Closure $closure, int $amount = 100)
    {
        // TODO: Implement chunk() method.
    }

    /**
     * @return int
     */
    public function total(): int
    {
        // TODO: Implement total() method.
    }

    /**
     * @param FilterWidget $filter
     * @param TableWidget $table
     * @return $this
     */
    public function prepare(FilterWidget $filter, TableWidget $table): Query
    {
        // TODO: Implement prepare() method.
    }

    /**
     * @param $id
     * @param string $field
     * @param $value
     * @return bool
     */
    public function edit($id, string $field, $value): bool
    {
        // TODO: Implement edit() method.
    }

    /**
     * @param bool $paginate
     * @return mixed
     */
    public function usePaginate(bool $paginate = false)
    {
        // TODO: Implement usePaginate() method.
    }

    /**
     * @param array $ids
     * @return $this
     */
    public function usePrimaryKey(array $ids = []): Query
    {
        // TODO: Implement usePrimaryKey() method.
    }

    /**
     * @return mixed
     */
    public function getPrimaryKey()
    {
        // TODO: Implement getPrimaryKey() method.
    }
}
