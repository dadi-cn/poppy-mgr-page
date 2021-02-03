<?php namespace Third\Http;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Routing\Router;
use Poppy\Framework\Application\RouteServiceProvider as PoppyFrameworkRouteServiceProvider;
use Route;

class RouteServiceProvider extends PoppyFrameworkRouteServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     * In addition, it is set as the URL generator's root namespace.
     * @var string
     */
    protected $namespace = 'Third\Http\Request';

    /**
     * Define your route model bindings, pattern filters, etc.
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the module.
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();
    }

    /**
     * Define the "web" routes for the module.
     * These routes all receive session state, CSRF protection, etc.
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            // todo auth
            'prefix' => 'third',
        ], function (Router $route) {
            require_once poppy_path('third', 'src/http/routes/web.php');
        });

        Route::group([
            'prefix'     => $this->prefix . '/third',
            'middleware' => 'backend-auth',
        ], function (Router $route) {
            require_once poppy_path('third', 'src/http/routes/backend.php');
        });
    }

    /**
     * Define the "api" routes for the module.
     * These routes are typically stateless.
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            // todo auth
            'prefix' => 'api/third',
        ], function (Router $route) {
            require_once poppy_path('third', 'src/http/routes/api.php');
        });
    }
}
