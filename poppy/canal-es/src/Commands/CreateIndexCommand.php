<?php
declare(strict_types = 1);

namespace Poppy\CanalEs\Commands;

use Illuminate\Console\Command;
use Poppy\CanalEs\Classes\Es\Index;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Throwable;

class CreateIndexCommand extends Command
{
    protected $name = 'canal-es:index-create';

    public function handle()
    {
        $indexName    = $this->argument('index');
        $propertyFile = (string) $this->option('property_class');

        if (!$indexName) {
            $this->error('Not enough arguments (missing: "index")');
            return;
        }

        $index = new Index($indexName, $propertyFile);

        try {
            $response = $index->create();
        } catch (Throwable $e) {
            $this->error($e->getMessage());
            return;
        }

        if (isset($response['index']) && $response['index'] === $indexName) {
            $this->info("index [$indexName] create success");
        }
    }

    protected function getArguments()
    {
        return [
            ['index', InputArgument::REQUIRED, 'the index name need to create'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['property_class', 'p', InputOption::VALUE_OPTIONAL, 'the index properties class to create'],
        ];
    }

}