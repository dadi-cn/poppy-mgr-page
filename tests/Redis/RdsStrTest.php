<?php

namespace Poppy\Core\Tests\Redis;

class RdsStrTest extends RdsBaseTest
{

    public function testSet()
    {
        $value  = $this->faker()->name;
        $key    = $this->key('str-set');
        $result = $this->rds->set($key, $value);
        $this->assertTrue($result);
        // 不存在则设置
        $result = $this->rds->set($key, $value, 'EX', 600, 'NX');
        $this->assertFalse($result);
        // 存在则设置
        $result = $this->rds->set($key, $value, 'EX', 600, 'XX');
        $this->assertTrue($result);
        // 存在则设置
        $result = $this->rds->set($key, $value, 'XX');
        $this->assertTrue($result);
        // 不存在则设置
        $result = $this->rds->set($key, $value, 'NX');
        $this->assertFalse($result);
        // 移除
        $this->rds->del($key);
        // 不存在则设置
        $result = $this->rds->set($key, $value, 'NX');
        $this->assertTrue($result);
        $this->rds->del($key);

        // 检测设置与获取
        $this->rds->set($key, $value);
        $res = $this->rds->get($key);
        $this->assertEquals($res, $value);
        $this->rds->set($key, [$value]);
        $res = $this->rds->get($key);
        $this->assertEquals($res, [$value]);
    }


    public function testSetEx()
    {
        $value  = $this->faker()->name;
        $key    = $this->key('str-setex');
        $result = $this->rds->setex($key, 20, $value);
        $this->assertTrue($result);
        $result = $this->rds->setex($key, 20, $value);
        $this->assertTrue($result);


        $this->rds->setex($key,20,  $value);
        $res = $this->rds->get($key);
        $this->assertEquals($res, $value);
        $this->rds->setex($key,20,  [$value]);
        $res = $this->rds->get($key);
        $this->assertEquals($res, [$value]);
    }
}