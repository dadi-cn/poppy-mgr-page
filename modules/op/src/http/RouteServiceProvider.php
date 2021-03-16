<?php

namespace Op\Http;

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
		$this->mapApiRoutes();
	}


	protected function mapApiRoutes()
	{
		\Route::group([
			'prefix' => 'api_v1/maintain',
		], function (Router $route) {
			require_once poppy_path('op', 'src/http/routes/api_v1_maintain.php');
		});
	}
}
