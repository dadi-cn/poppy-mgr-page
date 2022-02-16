<?php


namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Http\Lists\ListBase;
use Poppy\MgrApp\Widgets\FilterWidget;

/**
 * 按钮
 */
class GridPoppyFilter extends ListBase
{
    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('title', '标题');
        $this->column('desc', '描述');
    }


    /**
     * @inheritDoc
     */
    public function filter(FilterWidget $filter)
    {
        $filter->like('username', '用户名')->width(4)->text('模糊搜索');
        $filter->equal('username', 'ID')->width(4)->text('相等搜索');
        $filter->gt('username', '英雄数量')->width(4)->text('大于');
        $filter->lt('username', '英雄数量')->width(4)->text('小于');
        $filter->equal('username', '月份')->width(4)->month();
        $filter->equal('username', 'Datetime')->width(4)->datetime();
        $filter->equal('username', 'Date')->width(4)->date();
        $filter->equal('username', 'Year')->width(4)->year();
        $filter->equal('username', '选择')->width(4)->select([
            'a' => 'a',
            'b' => 'b'
        ], '选择');
        $filter->equal('username', '多选')->width(4)->multipleSelect([
            'a' => 'a',
            'b' => 'b'
        ], '选择');
        $filter->equal('username', '单选')->width(4)->select([
            'a' => 'a',
            'b' => 'b'
        ]);
        $filter->in('username', 'checkbox')->width(4)->multipleSelect([
            'a' => 'a',
            'b' => 'b'
        ]);
        $filter->action();
    }
}
