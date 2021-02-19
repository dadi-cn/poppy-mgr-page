<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Canal;

use xingwenge\canal_php\adapter\CanalConnectorBase;
use xingwenge\canal_php\CanalConnectorFactory;

class Client
{
    /**
     * @return CanalConnectorBase|\xingwenge\canal_php\adapter\clue\CanalConnector|\xingwenge\canal_php\adapter\socket\CanalConnector|\xingwenge\canal_php\adapter\swoole\CanalConnector
     * @throws \Exception
     */
    public static function createClient()
    {
        $config = self::config();

        $client = CanalConnectorFactory::createClient($config->getClientType());
        $client->connect($config->getHost(), $config->getPort());

        $client->subscribe($config->getClientId(),
            $config->getDestination(),
            $config->getFilter()
        );

        return $client;
    }

    /**
     * @return Config
     */
    private static function config(): Config
    {
        return new Config(config('canal'));
    }
}