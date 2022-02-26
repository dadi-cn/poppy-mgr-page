<?php


namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Grid\Filter\Render\Where;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 按钮
 */
class GridPoppyFilterWhere extends GridBase
{
    public string $title       = 'Where';

    public string $description = '描述';

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
        $filter->where(function ($query) {
            /** @var Where $this */
            $query->where('title', 'like', "%{$this->value}%");
        }, '标题')->text('标题模糊搜索');
        $filter->action();
    }
}
