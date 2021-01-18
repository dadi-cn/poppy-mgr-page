<?php namespace Site;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;
use Site\Classes\FormBuilder;
use Site\Http\RouteServiceProvider;

class ServiceProvider extends ModuleServiceProviderBase
{
	/**
	 * @var string the poppy name slug
	 */
	private $name = 'site';

	/**
	 * Bootstrap the module services.
	 * @return void
	 * @throws ModuleNotFoundException
	 */
	public function boot(): void
	{
		parent::boot($this->name);
	}

	/**
	 * Register the module services.
	 * @return void
	 */
	public function register(): void
	{
		$this->app->register(RouteServiceProvider::class);

		$this->registerSingleton();
		$this->registerCommand();

	}

	private function registerSingleton(): void
	{
		$this->app->singleton('site.form', function ($app) {
			$form = new FormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token());
			return $form->setSessionStore($app['session.store']);
		});
	}

	public function provides(): array
	{
		return [
			'site.form',
		];
	}

	private function registerCommand()
	{
		$this->commands([
			Commands\ExtCommand::class,
			Commands\QijiaCommand::class,
			Commands\NjgjCommand::class,
			Commands\LcFullCommand::class,
		]);
	}
}
