<?php

namespace Poppy\Core\Tests\Redis;


use Carbon\Carbon;
use Poppy\Core\Redis\RdsDb;
use Poppy\Framework\Application\TestCase;
use Predis\Client;

class RdsNativeTest extends TestCase
{
    /**
     * @var RdsDb
     */
    private $rds;

    public function setUp(): void
    {
        parent::setUp();
        $this->rds = new RdsDb();
    }

    /**
     * @
     */
    public function testZRange(): void
    {
        $key = 'test:system:cache:rds_native:zrange';
        $this->rds->zadd($key, [
            1 => Carbon::now()->timestamp - 10,
            2 => Carbon::now()->timestamp,
        ]);
        $arr = $this->rds->zrangebyscore($key, Carbon::now()->timestamp - 5, Carbon::now()->timestamp + 5, [
            'WITHSCORES' => true,
        ]);
        $this->assertNotEmpty($arr[2]);

        dump($this->rds->zscore($key, 3));
    }

    public function testSrandMember()
    {
        $key = 'test:system:cache:rds_native:srandmember';

        $this->rds->sadd($key, [
            1, 2, 4, 3, 5, 8, 9, 10,
        ]);

        $this->rds->srem($key, 1);

        dd($this->rds->sscan($key));
    }

    public function testGeo()
    {
        $cache = new RdsDb('money');

        $key   = 'test_geo';
        $count = 200000;

        for ($i = 1; $i <= $count; $i++) {
            $cache->geoadd($key, $this->faker()->longitude, 45.123456, $i);
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
