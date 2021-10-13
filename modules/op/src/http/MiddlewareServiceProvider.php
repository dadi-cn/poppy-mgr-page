<?php namespace Op\Http;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Op\Http\Middlewares\MaintainTokenMiddleware;

class MiddlewareServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $router->aliasMiddleware('op.maintain', MaintainTokenMiddleware::class);
    }
}