<?php


namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Http\Lists\ListBase;
use Poppy\MgrApp\Widgets\FilterWidget;

/**
 * 按钮
 */
class GridPoppyFilterB extends ListBase
{
    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', 'ID');
        $this->column('title', '标题');
        $this->column('score', '分数');
        $this->column('age', '年龄');
        $this->column('username', '用户名');
        $this->column('is_open', '启用')->display(function () {
            return data_get($this, 'is_open') ? '启用' : '禁用';
        });
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
        $filter->gt('score', '分数')->width(2)->text('分数');
        $filter->lt('age', '年龄')->width(2)->text('年龄');
        $filter->in('status', '状态')->width(4)->multipleSelect([
            1 => '未发布',
            2 => '草稿',
            5 => '待审核',
            3 => '已发布',
            4 => '已删除',
        ]);
        $filter->action();
    }
}
