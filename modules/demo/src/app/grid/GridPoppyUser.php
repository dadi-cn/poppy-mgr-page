<?php
/*
 * This is NOT a Free software.
 * When you have some Question or Advice can contact Me.
 * @author     Duoli <zhaody901@126.com>
 * @copyright  Copyright (c) 2013-2022 Poppy Team
 */

namespace Demo\App\Grid;

use Closure;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Grid\Filter;
use Poppy\MgrApp\Http\Lists\ListBase;

class GridPoppyUser extends ListBase
{
    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        // 自定义样式
        $this->column('pam.username', 'UserName')->width(100);
    }


    /**
     * @inheritDoc
     * @return Closure
     */
    public function filter(): Closure
    {
        return function (Filter $filter) {
            $filter->column(1, function (Filter $filter) {
                $filter->like('username', 'username');
            });
            // todo 这里应该是支持地区的
            // $filter->column(1, function (Filter $filter) {
            // $filter->area('area', 'area');
            // });
            $filter->column(2, function (Filter $filter) {
                $filter->betweenDate('id', 'Between')->withTime();
            });
            $filter->column(2, function (Filter $filter) {
                $filter->lt('datetime', 'Datetime')->datetime();
            });
            $filter->column(2, function (Filter $filter) {
                $filter->lt('date', 'Date')->date();
            });
            $filter->column(2, function (Filter $filter) {
                $filter->lt('time', 'Time')->time();
            });
        };
    }
}
