<?php namespace Op;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Console\Scheduling\Schedule;
use Op\Commands\MwebCommand;
use Op\Commands\TestCommand;
use Op\Http\MiddlewareServiceProvider;
use Op\Http\RouteServiceProvider;
use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;


class ServiceProvider extends ModuleServiceProviderBase
{
	/**
	 * @var string the poppy name slug
	 */
	private $name = 'op';

	/**
	 * Bootstrap the module services.
	 * @return void
	 * @throws ModuleNotFoundException
	 */
	public function boot()
	{
		parent::boot($this->name);
	}

	/**
	 * Register the module services.
	 * @return void
	 */
	public function register()
	{
		$this->app->register(MiddlewareServiceProvider::class);
		$this->app->register(RouteServiceProvider::class);
		$this->registerCommands();

		$this->registerSchedule();
	}

	private function registerSchedule()
	{
		app('events')->listen('console.schedule', function (Schedule $schedule) {

		});
	}

	private function registerCommands()
	{
		$this->commands([
			MwebCommand::class,
			TestCommand::class,
		]);
	}

}
