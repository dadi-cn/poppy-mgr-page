<?php namespace Suggest\Http;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to your controller routes.
	 * In addition, it is set as the URL generator's root namespace.
	 * @var string
	 */
	protected $namespace = 'Suggest\Http\Request';

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
		\Route::group([
			'prefix' => 'suggest',
		], function (Router $route) {
			require_once poppy_path('suggest', 'src/http/routes/web.php');
		});

		\Route::group([
			'prefix' => 'backend/suggest',
		], function (Router $route) {
			require_once poppy_path('suggest', 'src/http/routes/backend.php');
		});
	}

	/**
	 * Define the "api" routes for the module.
	 * These routes are typically stateless.
	 * @return void
	 */
	protected function mapApiRoutes()
	{
		\Route::group([
			// todo auth
			'prefix' => 'api/suggest',
		], function (Router $route) {
			require_once poppy_path('suggest', 'src/http/routes/api.php');
		});
	}
}
