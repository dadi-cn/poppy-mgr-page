<?php namespace Poppy\MgrPage\Http;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Routing\Router;
use Poppy\System\Classes\Abstracts\SysRouteServiceProvider;
use Route;

class RouteServiceProvider extends SysRouteServiceProvider
{
    /**
     * Define the routes for the module.
     * @return void
     */
    public function map(): void
    {
        $this->mapBackendRoutes();

        $this->mapDevRoutes();
    }

    /**
     * Define the "web" routes for the module.
     * These routes all receive session state, CSRF protection, etc.
     * @return void
     */
    protected function mapBackendRoutes(): void
    {
        // backend
        Route::group([
            'prefix' => $this->prefix,
        ], function (Router $router) {
            $router->any('/', 'Poppy\MgrPage\Http\Request\Backend\HomeController@index')
                ->middleware('backend-auth')
                ->name('py-mgr-page:backend.home.index');
            $router->any('login', 'Poppy\MgrPage\Http\Request\Backend\HomeController@login')
                ->middleware('web')
                ->name('py-mgr-page:backend.home.login');
        });

        Route::group([
            'prefix'     => $this->prefix . '/system',
            'middleware' => 'backend-auth',
        ], function () {
            require_once __DIR__ . '/Routes/backend.php';
        });
    }

    /**
     * Define the "web" routes for the module.
     * These routes all receive session state, CSRF protection, etc.
     * @return void
     */
    protected function mapDevRoutes(): void
    {
        // develop
        Route::group([
            'middleware' => 'web',
            'prefix'     => $this->prefix . '/develop',
        ], function (Router $router) {
            $router->any('login', 'Poppy\MgrPage\Http\Request\Develop\PamController@login')
                ->name('py-mgr-page:develop.pam.login');
            $router->get('/', 'Poppy\MgrPage\Http\Request\Develop\CpController@index')
                ->middleware('develop-auth')
                ->name('py-mgr-page:develop.cp.cp');
        });
        Route::group([
            'prefix'     => $this->prefix . '/develop/mgr-page',
        ], function () {
            require_once __DIR__ . '/Routes/develop.php';
        });
    }
}