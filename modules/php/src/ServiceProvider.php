<?php namespace Php;

/**
 * Copyright (C) Update For IDE
 */

use Php\Commands\ExamCommand;
use Php\Commands\LaravelCommand;
use Php\Events\EventRunEvent;
use Php\Http\MiddlewareServiceProvider;
use Php\Http\RouteServiceProvider;
use Php\Listeners\EventRun\FirstListener;
use Php\Listeners\EventRun\SecondListener;
use Php\Listeners\EventRun\ThirdListener;
use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;

class ServiceProvider extends ModuleServiceProviderBase
{
	/**
	 * @var string the poppy name slug
	 */
	private $name = 'php';

	protected $listens = [
		EventRunEvent::class => [
			FirstListener::class,
			SecondListener::class,
			ThirdListener::class,
		],
	];

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

		$this->commands([
			ExamCommand::class,
			LaravelCommand::class,
		]);
	}
}
