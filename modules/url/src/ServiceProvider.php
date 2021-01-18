<?php namespace Url;

use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;
use Url\Http\RouteServiceProvider;

class ServiceProvider extends ModuleServiceProviderBase
{
	/**
	 * @var string the poppy name slug
	 */
	private $name = 'url';

	protected $policies = [
		Models\UrlCollection::class => Models\Policies\UrlCollectionPolicy::class,
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
