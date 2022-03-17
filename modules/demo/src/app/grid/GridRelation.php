<?php

namespace Demo\App\Grid;

use Poppy\MgrApp\Http\Grid\GridBase;

class GridRelation extends GridBase
{
    public string $title = '关联关系';

    /**
     * @inheritDoc
     */
    public function columns()
    {
        // 自定义样式
        $this->column('title', '标题')->quickTitle();
        $this->column('user.nickname', 'Nickname(User)')->quickTitle();
        $this->column('user.id', 'ID(User)')->quickId()->sortable();
        $this->column('comment:id', '评论(Comment)')->quickTitle();
        $this->column('created_at')->quickDatetime();
    }
}
