<?php


namespace Demo\App\Filter;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 按钮
 */
class FilterScope extends GridBase
{
    public string $title = 'Scope';

    public string $description = '全局范围筛选';

    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', 'ID')->width(150)->sortable();
        $this->column('title', '标题')->width(200)->ellipsis();
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
        $filter->like('title', '标题');
        $filter->scope('none', '未发布')->where('status', 1);
        $filter->scope('wait', '待发布')->where('status', 2);
        $filter->action();
    }
}
