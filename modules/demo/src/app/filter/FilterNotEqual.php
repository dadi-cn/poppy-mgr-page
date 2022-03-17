<?php

namespace Demo\App\Filter;

use Demo\Models\DemoUser;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Http\Grid\GridBase;

class FilterNotEqual extends GridBase
{
    public string $title = '不等于';

    /**
     * @inheritDoc
     */
    public function columns()
    {
        $this->column('id', 'ID')->quickId()->sortable();
        $this->column('user.id', 'UID')->quickId()->align('center');
        $this->column('title', '标题')->quickTitle();
    }


    /**
     * @inheritDoc
     */
    public function filter(FilterWidget $filter)
    {
        $filter->action();
        $filter->notEqual('id', 'ID')->asText();
        $filter->notEqual('account_id', 'Uid!=(Select)')->asSelect(DemoUser::where('id', '<', 10)->pluck('id', 'id')->toArray(), '选择用户');
    }
}
