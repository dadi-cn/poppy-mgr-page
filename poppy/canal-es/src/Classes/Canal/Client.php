<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal;

use Exception;
use Poppy\CanalEs\Classes\IndexManager;
use xingwenge\canal_php\adapter\CanalConnectorBase;
use xingwenge\canal_php\adapter\swoole\CanalConnector;
use xingwenge\canal_php\CanalConnectorFactory;

class Client
{
    /**
     * @param $index
     * @return CanalConnectorBase|CanalConnector
     * @throws Exception
     */
    public static function createClient($index)
    {
        $config = self::config($index);

        $client = CanalConnectorFactory::createClient($config->getClientType());
        $client->connect($config->getHost(), $config->getPort());

        $client->subscribe($config->getClientId(),
            $config->getDestination(),
            $config->getFilter()
        );

        return $client;
    }

    /**
     * @param string $index 配置的索引信息
     * @return Config
     */
    private static function config(string $index): Config
    {
        $instance    = IndexManager::instance($index);
        $destination = $instance->destination();
        $filter      = $instance->filter();
        $confCanal   = config('poppy.canal-es.canal');
        return new Config(array_merge($confCanal, compact('destination', 'filter')));
    }
}