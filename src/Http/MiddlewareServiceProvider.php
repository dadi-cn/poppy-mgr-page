<?php namespace Poppy\MgrPage\Http;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        /* MgrPage Permission
         * ---------------------------------------- */
        $router->aliasMiddleware('mgr-permission', Middlewares\RbacPermission::class);

        $router->middlewareGroup('develop-auth', [
            'web',
            'sys-csrf_token',
            'sys-site_open',
            'sys-auth_session',
            'sys-auth:develop',
            'sys-disabled_pam',
            'mgr-permission',
            'sys-encrypt_cookies',
        ]);

        $router->middlewareGroup('backend-auth', [
            'web',
            'sys-csrf_token',
            'sys-auth_session',
            'sys-auth:backend',
            'sys-disabled_pam',
            'sys-encrypt_cookies',
            'mgr-permission',
        ]);
    }
}