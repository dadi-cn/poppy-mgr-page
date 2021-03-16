<?php

namespace Php\Commands;

use Illuminate\Console\Command;
use xingwenge\canal_php\CanalClient;
use xingwenge\canal_php\CanalConnectorFactory;
use xingwenge\canal_php\Fmt;

/**
 * 持久化获取数据
 */
class CanalCommand extends Command
{

    protected $signature = 'php:canal';

    protected $description = 'Generate Exam Document';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $client = CanalConnectorFactory::createClient(CanalClient::TYPE_SOCKET_CLUE);
            # $client = CanalConnectorFactory::createClient(CanalClient::TYPE_SWOOLE);

            $client->connect("127.0.0.1", 11111);
            $client->checkValid();
            $client->subscribe("1001", "example", "canal_example.koubei_car");
            # $client->subscribe("1001", "example", "db_name.tb_name"); # 设置过滤

            while (true) {
                $message = $client->get(100);
                if ($entries = $message->getEntries()) {
                    foreach ($entries as $entry) {
                        Fmt::println($entry);
                    }
                }
                sleep(1);
            }

            $client->disConnect();
        } catch (\Exception $e) {
            echo $e->getMessage(), PHP_EOL;
        }
    }
}