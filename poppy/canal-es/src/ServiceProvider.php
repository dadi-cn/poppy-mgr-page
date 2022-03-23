<?php

namespace Poppy\CanalEs;

use Poppy\CanalEs\Commands\MonitorCommand;
use Poppy\CanalEs\Commands\CreateIndexCommand;
use Poppy\CanalEs\Commands\ImportCommand;
use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;

class ServiceProvider extends ModuleServiceProviderBase
{
    /**
     * @var string the poppy name slug
     */
    private $name = 'poppy.canal-es';

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
        $this->commands([
            MonitorCommand::class,
            CreateIndexCommand::class,
            ImportCommand::class,
        ]);
    }
}
