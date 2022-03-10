<?php

namespace Poppy\MgrApp\Http\Grid;

use Illuminate\Support\Str;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Grid\Column\Render\ActionsRender;
use Poppy\MgrApp\Classes\Grid\Filter\Render\Scope;
use Poppy\MgrApp\Classes\Grid\Tools\Actions;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\System\Models\PamAccount;
use Poppy\System\Models\PamRole;
use Poppy\System\Models\PamRoleAccount;

class GridPamAccount extends GridBase
{

    public string $title = '账号管理';

    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', "ID")->sortable()->width(90, true)->align('center');
        $this->column('username', "用户名");
        $this->column('mobile', "手机号");
        $this->column('email', "邮箱");
        $this->column('login_times', "登录次数")->width(90, true)->align('center');
        $this->column('created_at', "操作时间")->width(170, true);
        $pam = $this->pam;
        $this->column('action', '操作')->displayUsing(ActionsRender::class, [function (ActionsRender $actions) use ($pam) {
            $row = $actions->getRow();
            $actions->default(['plain', 'circle', 'only']);
            $actions->page('修改密码', route('py-mgr-app:api-backend.pam.password', [data_get($row, 'id')]), 'form')->icon('Key');
            if ($pam->can('disable', $row)) {
                $actions->page('禁用', route_url('py-mgr-app:api-backend.pam.disable', [data_get($row, 'id')]), 'form')->icon('MuteNotification')->danger();
            }
            if ($pam->can('enable', $row)) {
                $actions->page('启用', route_url('py-mgr-app:api-backend.pam.enable', [data_get($row, 'id')]), 'form')->icon('Select')->success();
            }
            $actions->page("编辑", route_url('py-mgr-app:api-backend.pam.establish', [data_get($row, 'id')]), 'form')->icon('Edit');
        }])->width(150, true)->fixed();
    }

    /**
     * @inheritDoc
     */
    public function filter(FilterWidget $filter)
    {
        $types = PamAccount::kvType();
        $type  = input(Scope::QUERY_NAME);
        foreach ($types as $t => $v) {
            if (!$type) {
                $type = $t;
            }
            $filter->scope($t, $v)->where('type', $t);
        }
        $roles = PamRole::getLinear($type);
        $filter->where(function ($query) {
            $passport = input('passport');
            $type     = PamAccount::passportType($passport);
            if ($type === PamAccount::REG_TYPE_MOBILE && !Str::contains($passport, '-')) {
                // 默认拼接国内手机号
                $passport = '86-' . $passport;
            }
            $query->where($type, $passport);
        }, '手机/用户名/邮箱', 'passport')->width(4);
        $filter->where(function ($query) {
            $roleId      = data_get($this, 'input');
            $account_ids = PamRoleAccount::where('role_id', $roleId)->pluck('account_id');
            $query->whereIn('id', $account_ids);
        }, '用户角色', 'role_id')->select($roles);
    }


    public function quickActions(Actions $actions)
    {
        $actions->page('新增账号', route_url('py-mgr-app:api-backend.pam.establish'), 'form')->icon('CirclePlus');
    }
}
