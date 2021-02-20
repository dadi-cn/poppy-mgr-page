<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Commands;


use Illuminate\Console\Command;
use Poppy\CanalEs\Classes\Canal\Listener;
use Throwable;

class CanalCommand extends Command
{
    protected $name = 'ce:monitor';

    public function handle()
    {
        try {
            (new Listener())->monitor();
        } catch (Throwable $e) {
            echo $e->getMessage(), PHP_EOL;
        }
    }
}