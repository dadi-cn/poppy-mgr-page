<?php namespace Poppy\MgrPage\Http\Request\Backend;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\System\Action\Role;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Http\Forms\Backend\FormRoleEstablish;
use Poppy\System\Models\Filters\PamRoleFilter;
use Poppy\System\Models\PamAccount;
use Poppy\System\Models\PamRole;

/**
 * 角色管理控制器
 */
class RoleController extends BackendController
{

    public function __construct()
    {
        parent::__construct();
        $types = PamAccount::kvType();
        \View::share(compact('types'));

        self::$permission = [
            'global' => 'backend:py-system.role.manage',
            'delete' => 'backend:py-system.role.delete',
            'menu'   => 'backend:py-system.role.permissions',
        ];
    }

    /**
     * Display a listing of the resource.
     * @param Request $request request
     * @return \Response
     */
    public function index(Request $request)
    {
        $input         = $request->all();
        $type          = $input['type'] ?? PamAccount::TYPE_BACKEND;
        $input['type'] = $type;
        $items         = PamRole::filter($input, PamRoleFilter::class)->paginateFilter();

        return view('py-mgr-page::backend.role.index', compact('items', 'type'));
    }

    /**
     * 编辑 / 创建
     * @param null $id 角色id
     * @return Content
     * @throws ApplicationException
     */
    public function establish($id = null)
    {
        $form = new FormRoleEstablish();
        $form->setId($id);
        return (new Content())->body($form);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id 角色id
     * @return array|JsonResponse|RedirectResponse|Response|Redirector|Resp|\Response
     */
    public function delete($id)
    {
        $role = $this->action();
        if (!$role->delete($id)) {
            return Resp::error($role->getError());
        }

        return Resp::success('删除成功', '_top_reload|1');
    }

    /**
     * 带单列表
     * @param int $id 角色id
     * @return Factory|JsonResponse|RedirectResponse|Response|Redirector|View
     */
    public function menu(int $id)
    {
        $role = PamRole::find($id);
        if (is_post()) {
            $perms = (array) \Request::input('permission_id');
            $Role  = $this->action();
            if (!$Role->savePermission($id, $perms)) {
                return Resp::success($Role->getError());
            }

            return Resp::success('保存会员权限配置成功!', '_reload|1');
        }
        $permission = (new Role())->permissions($id);

        if (!$permission) {
            return Resp::error('暂无权限信息(请检查是否初始化权限)！');
        }

        return view('py-mgr-page::backend.role.menu', [
            'permission' => $permission,
            'role'       => $role,
        ]);
    }

    /**
     *
     * @return Role
     */
    private function action(): Role
    {
        return (new Role())->setPam($this->pam());
    }
}