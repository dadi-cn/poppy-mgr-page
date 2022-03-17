<?php

namespace Poppy\MgrApp\Classes\Grid\Query;

use Poppy\MgrApp\Classes\Contracts\Query;

class QueryFactory
{

    /**
     * @param null $model
     * @return Query
     */
    public static function create($model = null): Query
    {
        if ($model) {
            return new QueryModel($model);
        }
        // TODO: Implement get() method.
    }
}
