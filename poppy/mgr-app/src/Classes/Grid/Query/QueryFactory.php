<?php

namespace Poppy\MgrApp\Classes\Grid\Query;

use Illuminate\Database\Eloquent\Model;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Contracts\Query;

class QueryFactory
{

    /**
     * 返回查询对象
     * @param string|mixed $model
     * @return Query
     * @throws ApplicationException
     */
    public static function create($model = null): Query
    {
        if ($model instanceof Model) {
            return new QueryModel($model);
        } else {
            $obj = new $model;
            if ($obj instanceof Query) {
                throw new ApplicationException("Type of {$model} is not subclass of Query");
            }
            return new $model;
        }
    }
}
