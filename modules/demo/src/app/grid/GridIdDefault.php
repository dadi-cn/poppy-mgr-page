<?php

namespace Demo\App\Grid;

use Poppy\MgrApp\Classes\Grid\Tools\Actions;
use Poppy\MgrApp\Http\Grid\GridBase;

class GridIdDefault extends GridBase
{
    public string $title = '主键列默认返回';

    /**
     * @inheritDoc
     */
    public function columns()
    {
        // 自定义样式
        $this->column('title', '标题')->quickTitle();
        $this->column('user.nickname', 'Nickname(联合查询)')->quickTitle();
        $this->column('created_at')->quickDatetime();
    }

    public function batchActions(Actions $actions)
    {
        $actions->request('批量操作', route('demo:api.mgr_app.grid_request', ['success']));
    }
}
