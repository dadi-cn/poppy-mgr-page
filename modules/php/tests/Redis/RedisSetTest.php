<?php

namespace Php\Tests\Redis;

class RedisSetTest extends RedisBaseTest
{
    private static $key = 'rds-set';

    /**
     * 能添加数组和字串/ID, 并且ID 和字串相同时候被视为一个值
     */
    public function testSAdd()
    {

        if ($this->redis->sismember(self::$key, 1)) {
            $remNum = $this->redis->srem(self::$key, 1);
            $this->assertEquals(1, $remNum);
        }

        $result = $this->redis->sadd(self::$key, 1);
        $this->assertEquals(true, $result);

        $result = $this->redis->sadd(self::$key, '1');
        $this->assertEquals(false, $result);

        // add array
        $this->redis->sadd(self::$key, ['1', '2', '3', 4]);
    }

    /**
     * 检测数据的 Diff
     */
    public function testSDiff()
    {
        $diffKey = self::$key . '-diff';
        $this->redis->sadd($diffKey, 1);
        $this->redis->sadd(self::$key, ['1', '2', '3', 4]);
        $result = $this->redis->sdiff([self::$key, $diffKey]);
        $this->assertEquals(['2', '3', '4'], $result);
    }


    public function testSRandMember()
    {
        $randKey = self::$key . '-rand';
        $this->redis->sadd($randKey, range(1, 20));
        $rand = $this->redis->srandmember($randKey, 3);
        $this->assertCount(3, $rand);
    }
}