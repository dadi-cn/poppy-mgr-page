<?php

namespace Op\Http;


use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     * In addition, it is set as the URL generator's root namespace.
     * @var string
     */
    protected $namespace = 'Op\Request';

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
        Route::group([
            'prefix' => 'api_v1/op',
        ], function (Router $route) {
            require_once poppy_path('op', 'src/http/routes/api_v1.php');
        });
        Route::group([], function (Router $route) {
            require_once poppy_path('op', 'src/http/routes/web.php');
        });
    }
}
