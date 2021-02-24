<?php
declare(strict_types = 1);

namespace Poppy\CanalEs\Commands;

use Illuminate\Console\Command;
use Poppy\CanalEs\Classes\Es\Index;
use Poppy\CanalEs\Classes\IndexManager;
use Poppy\Framework\Helper\UtilHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Throwable;

class CreateIndexCommand extends Command
{
    protected $name = 'py-ce:create-index';

    public function handle()
    {
        $indexName    = $this->argument('index');
        $propertyFile = (string) $this->option('property');

        if (!$indexName) {
            $this->error('Not enough arguments (missing: "index")');
            return;
        }

        // 获取配置中的 property
        // 指定的优先级高于配置优先级
        $property = IndexManager::instance($indexName)->property();

        $propertyFile = $propertyFile ?: $property;

        $index = new Index($indexName, $propertyFile);

        try {
            $response = $index->create();
        } catch (Throwable $e) {
            if (UtilHelper::isJson($e->getMessage())) {
                $msg = json_decode($e->getMessage());
                $msg = data_get($msg, 'error.reason');
            }
            else {
                $msg = $e->getMessage();
            }
            $this->error($msg);
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
            ['property', 'p', InputOption::VALUE_OPTIONAL, 'the index properties class to create'],
        ];
    }

}