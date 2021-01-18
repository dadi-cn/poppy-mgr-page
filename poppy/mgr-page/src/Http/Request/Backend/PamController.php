<?php namespace Poppy\MgrPage\Http\Request\Backend;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\System\Classes\Grid;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Http\Forms\Backend\FormPamDisable;
use Poppy\System\Http\Forms\Backend\FormPamEnable;
use Poppy\System\Http\Forms\Backend\FormPamEstablish;
use Poppy\System\Http\Forms\Backend\FormPamPassword;
use Poppy\System\Models\Actions\PamAccountAction;
use Poppy\System\Models\PamAccount;
use Poppy\System\Models\PamLog;
use Poppy\System\Models\PamRole;
use Poppy\System\Models\PamRoleAccount;

/**
 * 账户管理
 */
class PamController extends BackendController
{
    public function __construct()
    {
        parent::__construct();

        self::$permission = [
            'global' => 'backend:py-system.pam.manage',
            'log'    => 'backend:py-system.pam.log',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pam  = $this->pam;
        $grid = new Grid(new PamAccount());
        $grid->setTitle('用户账号');
        $grid->column('id', "ID")->sortable()->width(80);
        $grid->column('username', "用户名");
        $grid->column('mobile', "手机号");
        $grid->column('email', "邮箱");
        $grid->column('login_times', "登录次数");
        $grid->column('created_at', "操作时间");
        $grid->column('type', "账号类型");

        // 排序
        $grid->model()->orderBy(input('_field', 'id'), input('_order', 'desc'));

        $grid->disableExport(true);

        $action = (new PamAccountAction($pam));
        $grid->appendQuickButton([
            $action->create(input('_scope_')),
        ]);

        $grid->expandFilter();
        $grid->filter(function (Grid\Filter $filter) {
            $type  = input('_scope_', PamAccount::TYPE_BACKEND);
            $roles = PamRole::getLinear($type);
            $filter->column(1 / 12, function (Grid\Filter $column) {
                $column->equal('passport', '手机/用户名/邮箱');
            });
            $filter->column(1 / 12, function (Grid\Filter $column) use ($roles) {
                $column->where(function ($query) {
                    $roleId      = data_get($this, 'input');
                    $account_ids = PamRoleAccount::where('role_id', $roleId)->pluck('account_id');
                    $query->whereIn('id', $account_ids);
                }, '用户角色', 'role_id')->select($roles);
            });
            $types = PamAccount::kvType();
            foreach ($types as $t => $v) {
                $filter->scope($t, $v)->where('type', $t);
            }
        });

        $grid->actions(function (Grid\Displayers\Actions $actions) use ($action) {
            $action->setItem($actions->row);
            $actions->append([
                $action->password(),
                $action->disable(),
                $action->enable(),
                $action->edit(),
            ]);
        });
        if (input('_query')) {
            return $grid->inquire($this->pagesize);
        }
        return (new Content())->body($grid->render());
    }

    /**
     * Show the form for creating a new resource.
     * @param null|int $id ID
     * @return Content
     */
    public function establish($id = null)
    {
        $form = new FormPamEstablish();
        $form->setType(input('type'))->setId($id);
        return (new Content())->body($form);
    }

    /**
     * 设置密码
     * @param int $id 用户ID
     * @return Content
     * @throws ApplicationException
     */
    public function password($id)
    {
        $form = new FormPamPassword();
        $form->setId($id);
        return (new Content())->body($form);
    }

    /**
     * 禁用用户
     * @param int $id 用户ID
     * @return Content
     */
    public function disable($id)
    {
        $form = new FormPamDisable();
        $form->setId($id);
        return (new Content())->body($form);
    }

    /**
     * 启用用户
     * @param int $id 用户ID
     * @return Content
     * @throws ApplicationException
     */
    public function enable($id)
    {
        $form = new FormPamEnable();
        $form->setId($id);
        return (new Content())->body($form);
    }

    public function log()
    {
        $grid = new Grid(new PamLog());
        $grid->setTitle('登录日志');
        $grid->column('id', "ID")->sortable()->width(80);
        $grid->column('pam.username', "用户名");
        $grid->column('created_at', "操作时间");
        $grid->column('ip', "IP地址");
        $grid->column('type', "状态");
        $grid->column('area_text', "说明");

        // 排序
        $grid->model()->orderBy(input('_field', 'id'), input('_order', 'desc'));

        $grid->disableExport(true);

        $grid->expandFilter();
        $grid->filter(function (Grid\Filter $filter) {
            $filter->column(1 / 12, function (Grid\Filter $column) {
                $column->equal('account_id', '用户ID');
            });
            $filter->column(1 / 12, function (Grid\Filter $column) {
                $column->equal('ip', 'IP地址');
            });
            $filter->column(1 / 12, function (Grid\Filter $column) {
                $column->like('area_text', '登录地区');
            });
        });
        if (input('_query')) {
            return $grid->inquire($this->pagesize);
        }
        return (new Content())->body($grid->render());
    }
}