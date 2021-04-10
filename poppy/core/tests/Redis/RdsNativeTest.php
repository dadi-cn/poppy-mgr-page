<?php

namespace Poppy\Core\Tests\Redis;


use Carbon\Carbon;
use Poppy\Core\Redis\RdsDb;
use Predis\Client;

class RdsNativeTest extends RdsBaseTest
{
    public function testZRange(): void
    {
        $key   = $this->key('db-zrange');
        $user1 = $this->faker()->userName;
        $user2 = $this->faker()->userName;

        $timestamp = Carbon::now()->timestamp;

        // 有序集合
        $this->rds->zadd($key, [
            $user1 => $timestamp - 10,
            $user2 => $timestamp,
        ]);

        // 根据分值获取有序集合的数据
        $arr = $this->rds->zrangebyscore($key, $timestamp - 5, $timestamp + 5, [
            'WITHSCORES' => true,
        ]);

        $this->assertEquals($timestamp, $arr[$user2]);

        $this->assertCount(1, $arr);

        // 根据用户获取分值
        $score = $this->rds->zscore($key, $user2);
        $this->assertEquals($timestamp, $score);

        $this->rds->del($key);
    }

    public function testSRandMember()
    {
        $key = $this->key('db-srandmember');

        $max = 100;
        $this->rds->sadd($key, range(1, $max));

        $rand = rand(1, 50);
        $this->rds->srem($key, $rand);

        $result = $this->rds->scard($key);
        $this->assertEquals($result, $max - 1, 'Error Length @ SRandMember');

        $this->rds->del($key);

    }

    public function testGeo()
    {
        $key   = $this->key('db-geo');
        $count = 1000;

        for ($i = 1; $i <= $count; $i++) {
            $this->rds->geoadd($key, $this->faker()->longitude(), $this->faker()->latitude(), $i);
        }
    }

    public function testDist()
    {
        $cache = new RdsDb('money');

        $key = 'test_geo';

        $start = microtime(true);

        $redis   = new Client();
        $members = $cache->georadiusbymember($key, 4, 500, 'km', ['storedist' => 'play:test_geo_page', 'count' => '100']);

        $users = $cache->zrange('test_geo_page', 0, -1, ['withscores' => true]);

        dump(microtime(true) - $start);

        dump($users);

        dd($members);
    }
}
