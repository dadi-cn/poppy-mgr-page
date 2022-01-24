<?php

namespace Php\Tests\VariableType;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Framework\Application\TestCase;

class ArrayTest extends TestCase
{
    /**
     * 文字长度处理
     */
    public function testReset(): void
    {
        $arr = [
            'f' => 'n',
        ];
        $this->assertIsNotArray(reset($arr));
    }

    public function testDiff()
    {
        $formerKey = array_keys([
            'hot_num' => 4,
        ]);
        $updateKey = array_keys([
            'password' => '2333',
        ]);
        $diffKeys  = array_diff($updateKey, $formerKey);
        $this->assertEquals('password', reset($diffKeys));

        $total      = [1, 3, 5, 7, 9, 10];
        $append     = [1, 4, 5, 7, 11];
        $appendDiff = array_diff($append, $total);
        $this->assertCount(2, $appendDiff);
    }

    public function testDiffKey()
    {
        $diffs = array_diff_key([
            'password' => '2333',
        ], [
            'hot_num' => 4,
        ]);
        $this->assertEquals('2333', $diffs['password']);
    }

    /**
     * flip 之后保留哪个
     */
    public function testFlip()
    {
        $arr = [
            'a' => '1',
            'b' => '1',
        ];
        $rev = array_flip($arr);
        $this->assertEquals('b', $rev['1']);
    }

    /**
     * 向数组头部追加数据
     */
    public function testUnshift()
    {
        $items = [
            'fun' => 'fun-v',
        ];
        $items = array_merge([
            'order' => 'order-v',
        ], $items);
        $this->assertCount(2, $items);
    }

    public function testPlus()
    {
        $arrayA = [
            'a' => -1,
            'b' => -2,
        ];
        $arrayB = [
            'b' => 2,
            'c' => 3,
        ];
        // question 面试题目, 数组相加的时候会出现的bug 问题
        $result = $arrayA + $arrayB;
        $this->assertEquals(-2, $result['b']);
    }


    public function testIsset()
    {
        $af = $d['a']['f'] ?? 'none';
        $this->assertEquals('none', $af, 'Isset Check');
    }

    public function testInArray(): void
    {
        $in = in_array('4', [2, 4], true);
        $this->assertFalse($in);
    }


    public function testPush()
    {
        $arr = [];
        array_push($arr, 1);
        $this->assertEquals([1], $arr);
    }


    /**
     * 数组中的数据
     * @return void
     */
    public function testIntersect()
    {
        $arr = [
            [1, 2, 3, 4],
            [3, 1, 6, 9],
            [1, 8],
            [1, 0, 9],
        ];
        $res = call_user_func_array('array_intersect', $arr);
        $this->assertEquals(1, $res[0]);
    }

    /**
     * 数组迭代减少, 使用回调函数
     */
    public function testReduce()
    {
        $extensions = [
            'excel' => ['xlsx', 'xlsb', 'xls', 'xlsm'],
            'doc'   => ['docx', 'dotx'],
            'pdf'   => ['pdf'],
            'ppt'   => ['pptx', 'ppt', 'pps', 'potx', 'ppsm'],
        ];

        $values = array_reduce($extensions, function ($carry, $item) {
            return array_merge($carry, $item);
        }, []);
        $this->assertCount(12, $values);
    }
}