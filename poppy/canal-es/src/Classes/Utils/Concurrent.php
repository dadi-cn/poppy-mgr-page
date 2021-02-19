<?php

declare(strict_types = 1);

namespace Poppy\CanalEs\Classes\Utils;


use Hyperf\Utils\Coroutine;
use Swoole\Coroutine\Channel;
use Throwable;

class Concurrent
{
    /**
     * @var Channel $channel
     */
    protected $channel;

    /**
     * @var int $limit
     */
    protected $limit;

    public function __construct(int $limit)
    {
        $this->limit   = $limit;
        $this->channel = new Channel($limit);
    }

    public function __call($name, $arguments)
    {
        if (in_array($name, ['isFull', 'isEmpty', 'length', 'stats'])) {
            return $this->channel->{$name}(...$arguments);
        }
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getLength(): int
    {
        return $this->channel->length();
    }

    public function getRunningCoroutineCount(): int
    {
        return $this->getLength();
    }

    public function create(callable $callable): void
    {
        $this->channel->push(true);

        Coroutine::create(function () use ($callable) {
            try {
                $response = $callable();
                if (isset($response['errors']) && $response['errors']) {
                    var_dump($response);
                }
            } catch (Throwable $exception) {
                var_dump($exception->getMessage());
            } finally {
                $this->channel->pop();
            }
        });
    }
}