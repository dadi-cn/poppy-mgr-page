<?php

namespace Poppy\MgrApp\Services\System;

use Poppy\Core\Services\Contracts\ServiceArray;

class ApiInfo implements ServiceArray
{

    public function key(): string
    {
        return 'py-mgr-app';
    }

    public function data(): array
    {
        return [
            'auth_url' => route('py-system:pam.auth.login'),
            'info_url' => route('py-mgr-app:api-backend.user.info'),
        ];
    }
}