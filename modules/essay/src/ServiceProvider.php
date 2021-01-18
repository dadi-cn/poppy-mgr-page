<?php namespace Essay;

/**
 * Copyright (C) Update For IDE
 */

use Essay\Http\RouteServiceProvider;
use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;

class ServiceProvider extends ModuleServiceProviderBase
{
	/**
	 * @var string the poppy name slug
	 */
	private $name = 'essay';

	protected $policies = [
		Models\ArticleContent::class => Models\Policies\ArticleContentPolicy::class,
		Models\ArticleBook::class    => Models\Policies\ArticleBookPolicy::class,
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
		$this->app->register(RouteServiceProvider::class);
	}
}
