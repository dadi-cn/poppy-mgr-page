<?php namespace Poppy\Demo;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider;

/**
 * @property $listens;
 */
class ServiceProvider extends PoppyServiceProvider
{
    /**
     * @var string Module name
     */
    protected $name = 'poppy.demo';

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
        $this->app->register(Http\RouteServiceProvider::class);
    }

    public function provides(): array
    {
        return [];
    }
}