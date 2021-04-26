<?php

namespace Poppy\Area;

use Poppy\Area\Classes\Form\Field\Area;
use Poppy\Area\Commands\InitCommand;
use Poppy\Area\Http\RouteServiceProvider;
use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;
use Poppy\System\Classes\Form;

class ServiceProvider extends ModuleServiceProviderBase
{
    /**
     * @var string the poppy name slug
     */
    private $name = 'poppy.area';

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
        $this->commands([
            InitCommand::class,
        ]);

        Form::extend('area', Area::class);
    }
}
