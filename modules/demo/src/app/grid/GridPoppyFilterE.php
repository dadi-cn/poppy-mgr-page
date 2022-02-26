<?php


namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 按钮
 */
class GridPoppyFilterE extends GridBase
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
        $filter->date('birth_at', '时间')->width(4);
        $filter->action();
    }
}
