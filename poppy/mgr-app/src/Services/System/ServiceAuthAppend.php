<?php

namespace Poppy\MgrApp\Services\System;

use Auth;
use Poppy\Core\Classes\Traits\CoreTrait;
use Poppy\Core\Exceptions\PermissionException;
use Poppy\Core\Services\Contracts\ServiceArray;
use Poppy\System\Models\PamAccount;

class ServiceAuthAppend implements ServiceArray
{
    use CoreTrait;

    public function key(): string
    {
        return 'menus';
    }

    /**
     * @throws PermissionException
     */
    public function data(): array
    {
        /** @var PamAccount $pam */
        $pam  = Auth::user();
        $type = $pam->type;
        return $this->coreModule()->path()->withPermission($type, false, $pam)->toArray();
    }
}