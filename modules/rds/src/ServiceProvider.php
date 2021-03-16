<?php

namespace Rds;

use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;
use Rds\Http\RouteServiceProvider;

class ServiceProvider extends ModuleServiceProviderBase
{
	protected $name = 'redis';


	/**
	 * Bootstrap the application events.
	 * @throws ModuleNotFoundException
	 */
	public function boot()
	{
		parent::boot($this->name);
	}

	public function register()
	{
		$this->app->register(RouteServiceProvider::class);
	}
}
