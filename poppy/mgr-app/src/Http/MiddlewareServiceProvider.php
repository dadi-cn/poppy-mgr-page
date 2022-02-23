<?php

namespace Poppy\MgrApp\Http;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        /* MgrPage Permission
         * ---------------------------------------- */
        $router->aliasMiddleware('mgr-app-rbac-permission', Middlewares\RbacPermission::class);

        $router->middlewareGroup('mgr-app-backend-auth', [
            'api',
            'sys-auth:jwt_backend',
            'sys-jwt',
            'sys-disabled_pam',
            'sys-ban:backend',
            'mgr-app-rbac-permission',
        ]);
    }
}