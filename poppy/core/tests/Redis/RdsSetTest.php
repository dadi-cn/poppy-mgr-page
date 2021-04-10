<?php

namespace Poppy\Core\Tests\Redis;

class RdsSetTest extends RdsBaseTest
{
    private static $key = 'rds-set';

    /**
     * 能添加数组和字串/ID, 并且ID 和字串相同时候被视为一个值
     */
    public function testSAdd()
    {

        if ($this->rds->sismember(self::$key, 1)) {
            $remNum = $this->rds->srem(self::$key, 1);
            $this->assertEquals(1, $remNum);
        }

        $result = $this->rds->sadd(self::$key, 1);
        $this->assertEquals(true, $result);

        $result = $this->rds->sadd(self::$key, '1');
        $this->assertEquals(false, $result);

        // add array
        $this->rds->sadd(self::$key, ['1', '2', '3', 4]);
    }

    /**
     * 检测数据的 Diff
     */
    public function testSDiff()
    {
        $diffKey = self::$key . '-diff';
        $this->rds->sadd($diffKey, 1);
        $this->rds->sadd(self::$key, ['1', '2', '3', 4]);
        $result = $this->rds->sdiff([self::$key, $diffKey]);
        $this->assertEquals(['2', '3', '4'], $result);
    }


    public function testSRandMember()
    {
        $randKey = self::$key . '-rand';
        $this->rds->sadd($randKey, range(1, 20));
        $rand = $this->rds->srandmember($randKey, 3);
        $this->assertCount(3, $rand);
    }
}