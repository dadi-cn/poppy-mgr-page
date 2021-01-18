<?php namespace Php\Http;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Route;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to your controller routes.
	 * In addition, it is set as the URL generator's root namespace.
	 * @var string
	 */
	protected $namespace = 'Php\Http\Request';

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

		$this->mapBackendRoutes();

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
			'prefix' => 'php',
		], function () {
			require_once poppy_path('php', 'src/http/routes/web.php');
		});

	}

	/**
	 * Define the "web" routes for the module.
	 * These routes all receive session state, CSRF protection, etc.
	 * @return void
	 */
	protected function mapBackendRoutes()
	{

		Route::group([
			'prefix'     => 'backend/php',
			'middleware' => ['backend', 'auth:backend', 'auth_session', 'disabled_pam', 'be_append_data', 'permission'],
		], function () {
			require_once poppy_path('php', 'src/http/routes/backend.php');
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
			'prefix' => 'api/php',
		], function () {
			require_once poppy_path('php', 'src/http/routes/api.php');
		});
	}
}
