<?php

namespace Poppy\Core\Tests\Redis;

use Poppy\Core\Classes\PyCoreDef;
use Poppy\Core\Redis\RdsDb;
use Poppy\Core\Redis\RdsFieldExpired;
use Poppy\Framework\Application\TestCase;
use Predis\Client;

/**
 * redis 字段filed有效期
 */
class RdsFieldExpiredTest extends TestCase
{

    /**
     * 设置有效期
     */
    public function testSetFieldExpireTime()
    {
        $databases = ['default'];
        $types     = [
            RdsFieldExpired::TYPE_ZSET,
            RdsFieldExpired::TYPE_SET,
            RdsFieldExpired::TYPE_HASH,
        ];
        $expired   = [1, 5, 60, 300];

        $caches = [];
        $count  = 100;

        $keyPrefix = uniqid('test', true);
        for ($i = 1; $i <= $count; $i++) {
            $database = $this->faker()->randomElement($databases);
            $type     = $this->faker()->randomElement($types);
            $key      = $keyPrefix . '_' . $type;
            $expire   = $this->faker()->randomElement($expired);

            $cache = new RdsDb($database);
            switch ($type) {
                case 'hash':
                    $cache->hset($key, $i, $i);
                    break;
                case 'set':
                    $cache->sadd($key, $i);
                    break;
                case 'zset':
                    $cache->zadd($key, [
                        $i => $i * 10,
                    ]);
                    break;
            }

            RdsFieldExpired::setFieldExpireTime($key, $i, $type, $database, $expire);

            $caches[$database . '_' . $key] = compact('database', 'key');

            $cache->disconnect();
            $cache = null;
        }

        $this->assertEquals($count, $this->cacheCount($caches));

    }

    /**
     * 过期
     */
    public function testExpired()
    {
        $cache = new Client(config('database.redis.default'));
        $cache->multi();
        $beforeCount = $cache->zcard(PyCoreDef::ckRdsKeyFieldExpired());

        (new RdsFieldExpired)->clearExpiredField();

        $afterCount = $cache->zcard(PyCoreDef::ckRdsKeyFieldExpired());

        $cache->exec();
        $this->assertGreaterThanOrEqual($beforeCount, $afterCount);
    }

    /**
     * @param $caches
     * @return int
     */
    private function cacheCount($caches): int
    {
        $count = 0;
        foreach ($caches as $item) {
            $database = $item['database'];
            $key      = $item['key'];

            [, $type] = explode('_', $key);

            $cache = new RdsDb($database);
            switch ($type) {
                case 'hash':
                    $count += $cache->hlen($key);
                    break;
                case 'set':
                    $count += $cache->scard($key);
                    break;
                case 'zset':
                    $count += $cache->zcard($key);
                    break;
            }
        }

        return $count;
    }
}