<?php

namespace Misc;

/**
 * Copyright (C) Update For IDE
 */

use Misc\Classes\FormBuilder;
use Misc\Http\RouteServiceProvider;
use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;

class ServiceProvider extends ModuleServiceProviderBase
{
    /**
     * @var string the poppy name slug
     */
    private $name = 'misc';

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

    public function provides(): array
    {
        return [
            'misc.form',
        ];
    }

    private function registerSingleton(): void
    {
        $this->app->singleton('misc.form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token());
            return $form->setSessionStore($app['session.store']);
        });
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
