<?php
declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Es;

use Elasticsearch\ClientBuilder;
use Poppy\CanalEs\Classes\Formatter\Format;
use Poppy\CanalEs\Classes\Utils\Concurrent;

class Document
{
    /**
     * @var Client $client
     */
    protected static $client;

    /**
     * @var Concurrent $runner
     */
    protected static $runner;

    /**
     * @var string
     */
    private $index;

    /**
     * @var Format
     */
    private $format;

    public function __construct(string $index = '')
    {
        self::$client = ClientBuilder::create()
            ->setHosts(config('poppy.canal-es.elasticsearch.hosts'))
            ->build();
        $this->index  = $index;
    }

    public function setFormat(Format $format): Document
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @param $records
     * @return array|callable
     */
    public function import($records)
    {
        return self::$client->bulk([
            'body' => $this->prepareImportDocument($records),
        ]);
    }

    public function bulk($records)
    {
        return self::$client->bulk([
            'body' => $records,
        ]);
    }


    /**
     * @param $rows
     * @return array
     */
    protected function prepareImportDocument($rows): array
    {
        $body = [];
        foreach ($rows as $row) {
            $update = [
                '_id'    => $row['id'],
                '_index' => $this->index,
            ];

            if ($this->format instanceof Format) {
                $row = $this->format->format($row);
            }

            $body[] = ['update' => $update,];
            $body[] = [
                'doc'           => $row,
                'doc_as_upsert' => true,
            ];
        }

        return $body;
    }

    /**
     * @return int
     */
    protected function syncConcurrencyCount(): int
    {
        return (int) config('poppy.canal-es.elasticsearch.concurrency', 100);
    }
}