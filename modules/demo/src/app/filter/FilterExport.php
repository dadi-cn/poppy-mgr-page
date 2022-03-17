<?php


namespace Demo\App\Filter;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 按钮
 */
class FilterExport extends GridBase
{
    public string $title = 'Export 导出';

    /**
     * @inheritDoc
     */
    public function columns()
    {
        $this->column('id', 'ID')->quickId()->sortable();
        $this->column('title', '标题')->quickTitle();
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
        $this->column('created_at', '创建时间');
        $this->column('birth_at', '发布时间');
    }

    /**
     * @inheritDoc
     */
    public function filter(FilterWidget $filter)
    {
        $filter->like('title', '标题')->asText('模糊搜索');
        $filter->action(6, true);
    }
}
