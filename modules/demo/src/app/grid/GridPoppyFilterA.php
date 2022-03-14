<?php


namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 按钮
 */
class GridPoppyFilterA extends GridBase
{
    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('title', '标题');
        $this->column('desc', '描述');
        $this->column('email', '邮箱');
        $this->column('username', '用户名');
        $this->column('is_open', '启用')->display(function () {
            return data_get($this, 'is_open') ? '启用' : '禁用';
        });
        $this->column('trashed', '删除状态')->display(function () {
            return data_get($this, 'trashed') ? '删除' : '未删除';
        });
    }


    /**
     * @inheritDoc
     */
    public function filter(FilterWidget $filter)
    {
        $filter->like('title', '标题')->width(4)->text('模糊搜索');
        $filter->startsWith('email', '邮箱前缀')->width(2)->text('使用邮箱前缀查询');
        $filter->endsWith('username', '用户名后缀')->width(2)->text('使用用户名后缀查询');
        $filter->equal('is_open', '是否启用')->width(2)->select([
            0 => '未启用',
            1 => '启用'
        ]);
        $filter->notEqual('trashed', '不等于')->width(2)->select([
            0 => '未删除',
            1 => '已删除'
        ]);
        $filter->action(4, true);
    }
}
