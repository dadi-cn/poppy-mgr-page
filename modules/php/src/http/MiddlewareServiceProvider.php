<?php

namespace Php\Http;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Php\Http\Middlewares\TestLoginMiddleware;
use Php\Http\Middlewares\TestMiddleware;

class MiddlewareServiceProvider extends ServiceProvider
{
	public function boot(Router $router)
	{
		$router->aliasMiddleware('php.test', TestMiddleware::class);
		$router->aliasMiddleware('php.test-login', TestLoginMiddleware::class);
	}
}