<?php

namespace Poppy\MgrApp\Classes\Grid\Query;

use Closure;
use Poppy\MgrApp\Classes\Contracts\Query;

class QueryCustom implements Query
{

    /**
     * @return mixed
     */
    public function get()
    {
        // TODO: Implement get() method.
    }

    /**
     * @param Closure $closure
     * @param int     $amount
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
     * @return bool
     */
    public function edit(): bool
    {
        // TODO: Implement edit() method.
    }
}
