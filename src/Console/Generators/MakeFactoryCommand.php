<?php

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
    	{slug : The slug of the module}
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
            $namespaceModel = poppy_class($this->argument('slug'), 'Models') . '\\' . class_basename($model);
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

    /**
     * @inheritDoc
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return poppy_class($this->argument('slug'), 'Database\\Factories');
    }
}
