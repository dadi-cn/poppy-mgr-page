<?php

namespace Poppy\Version;

use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;
use Poppy\Version\Http\RouteServiceProvider;

class ServiceProvider extends ModuleServiceProviderBase
{
    protected $listens = [

    ];
    /**
     * @var string the poppy name slug
     */
    private $name = 'poppy.version';

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
