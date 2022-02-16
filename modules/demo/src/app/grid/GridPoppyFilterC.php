<?php


namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Http\Lists\ListBase;
use Poppy\MgrApp\Widgets\FilterWidget;

/**
 * 按钮
 */
class GridPoppyFilterC extends ListBase
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
    }

    /**
     * @inheritDoc
     */
    public function filter(FilterWidget $filter)
    {
        $filter->notIn('status', '状态不是')->width(4)->multipleSelect([
            1 => '未发布',
            2 => '草稿',
            5 => '待审核',
            3 => '已发布',
            4 => '已删除',
        ]);
        $filter->action();
    }
}
