<?php


namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Grid\Tools\Actions;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 按钮
 */
class GridPoppyFilterBatchActions extends GridBase
{
    public string $title       = '批量操作';

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
    public function batchActions(Actions $actions)
    {
        $actions->request('批量删除', 'api/demo/grid_request/success')->primary()->confirm();
    }
}
