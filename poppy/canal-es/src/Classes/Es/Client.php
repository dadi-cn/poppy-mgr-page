<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Es;

use Elasticsearch\Client as EsClient;
use Elasticsearch\ClientBuilder;

class Client
{
    /**
     * @var EsClient $client
     */
    protected static $client;

    /**
     * @return EsClient
     */
    public static function instance(): EsClient
    {
        if (!static::$client instanceof EsClient) {
            static::$client = ClientBuilder::create()
                ->setHosts(config('elasticsearch.hosts'))
                ->build();
        }

        return static::$client;
    }

}