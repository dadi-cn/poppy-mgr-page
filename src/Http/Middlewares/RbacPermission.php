<?php

namespace Poppy\MgrPage\Http\Middlewares;

use Poppy\Core\Classes\Traits\CoreTrait;
use Poppy\Core\Rbac\Middlewares\RbacPermission as CoreRbacPermission;
use Poppy\Core\Rbac\Traits\RbacUserTrait;
use Poppy\System\Models\PamAccount;
use Poppy\System\Models\PamRole;

/**
 * 登录成功后之后向 view 中附加数据
 */
class RbacPermission extends CoreRbacPermission
{
    use CoreTrait;

    /**
     * Handle an incoming request.
     * @param PamAccount|RbacUserTrait $user
     * @return mixed
     */
    public function passed($user)
    {
        if ($user->type === PamAccount::TYPE_BACKEND && $user->hasRole(PamRole::BE_ROOT)) {
            return true;
        }
        return false;
    }
}