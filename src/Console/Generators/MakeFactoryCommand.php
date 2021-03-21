<?php
/*
 * This is NOT a Free software.
 * When you have some Question or Advice can contact Me.
 * @author     Duoli <zhaody901@126.com>
 * @copyright  Copyright (c) 2013-2021 Poppy Team
 */

namespace Poppy\Framework\Console\Generators;

use Poppy\Framework\Console\GeneratorCommand;

/**
 * Make Test File
 */
class MakeFactoryCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'poppy:factory
    	{name : The name of the factory class}
    	{--model= : Generate a model factory class}';


    /**
     * @inheritDoc
     */
    protected function buildClass($name)
    {
        $model = $this->option('model');
        if (!$model) {
            $model = 'FakerModel';
        }
        if (class_exists($model)) {
            $namespaceModel = $model;
        }
        else {
            $namespaceModel = $model;
        }

        $model = class_basename($namespaceModel);

        return str_replace(
            [
                'NamespacedDummyModel',
                'DummyModel',
            ],
            [
                $namespaceModel,
                $model,
            ],
            parent::buildClass($name)
        );
    }

    /**
     * @inheritDoc
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/factory.stub';
    }

    protected function getPath($name): string
    {
        $name = class_basename($name);
        return $this->laravel->databasePath('factories') . DIRECTORY_SEPARATOR . $name . '.php';
    }
}
