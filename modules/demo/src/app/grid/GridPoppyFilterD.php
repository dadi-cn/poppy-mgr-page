<?php


namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Http\Lists\ListBase;
use Poppy\MgrApp\Widgets\FilterWidget;

/**
 * 按钮
 */
class GridPoppyFilterD extends ListBase
{
    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', 'ID');
        $this->column('title', '标题');
        $this->column('status', '状态')->display(function () {
            $defs = [
                1 => '未发布',
                2 => '草稿',
                5 => '待审核',
                3 => '已发布',
                4 => '已删除',
            ];
            return $defs[data_get($this, 'status')] ?? '-';
        });
        $this->column('birth_at', '发布时间');
    }

    /**
     * @inheritDoc
     */
    public function filter(FilterWidget $filter)
    {
        $filter->between('status', '状态介于')->width(4)->text(['开始状态', '结束状态']);
        $filter->betweenDate('birth_at', '时间')->width(4)->date(['开始时间', '结束时间']);
        $filter->action();
    }
}
