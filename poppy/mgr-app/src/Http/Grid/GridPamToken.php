<?php

namespace Poppy\MgrApp\Http\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Grid\Column\Render\ActionsRender;

class GridPamToken extends GridBase
{

    public string $title = '登录用户管理';

    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', "ID")->sortable()->width(90, true)->align('center');
        $this->column('account_id', "用户ID")->width(90, true)->align('center');
        $this->column('device_type', "设备类型");
        $this->column('device_id', "设备ID")->width(320, false);
        $this->column('login_ip', "登录IP");
        $this->column('expired_at', "过期时间")->width(170, true);
        $this->column('action', '操作')->displayUsing(ActionsRender::class, [function (ActionsRender $actions) {
            $row = $actions->getRow();
            $actions->default(['plain', 'circle', 'only']);
            $actions->request('禁用IP', route('py-mgr-app:api-backend.pam.ban', [data_get($row, 'id'), 'ip']))->icon('MapLocation');
            $actions->request('禁用设备', route('py-mgr-app:api-backend.pam.ban', [data_get($row, 'id'), 'device']))->icon('Cellphone');
            $actions->request("删除", route_url('py-mgr-app:api-backend.pam.delete_token', [data_get($row, 'id')]))->icon('Close')->danger();
        }])->width(150, true)->fixed();
    }
}
