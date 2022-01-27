<?php

namespace Poppy\MgrApp\Http\Request\Api\Backend;

use Poppy\Core\Classes\Traits\CoreTrait;
use Poppy\Core\Exceptions\PermissionException;
use Poppy\Framework\Classes\Resp;
use Poppy\System\Models\PamAccount;
use Poppy\System\Models\PamRole;

/**
 * 用户
 */
class UserController extends BackendController
{
    use CoreTrait;

    /**
     * 主页
     * @throws PermissionException
     */
    public function info()
    {
        $isFullPermission = $this->pam->hasRole(PamRole::BE_ROOT);
        return Resp::success('获取成功', [
            'menus' => $this->coreModule()->menus()->withPermission(PamAccount::TYPE_BACKEND, $isFullPermission, $this->pam)
        ]);
    }
}