<?php

namespace Poppy\MgrApp\Http\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;

/**
 * 列表 PamLog
 */
class GridPamLog extends GridBase
{

    public string $title = '登录日志';

    /**
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', "ID")->sortable()->width(80);
        $this->column('pam.username', "用户名");
        $this->column('created_at', "操作时间");
        $this->column('ip', "IP地址");
        $this->column('type', "状态");
        $this->column('area_text', "说明");
    }


    public function filter(FilterWidget $filter)
    {
        $filter->equal('account_id', '用户ID');
        $filter->equal('ip', 'IP地址');
        $filter->like('area_text', '登录地区');
    }
}
