<?php

namespace Php\Tests\Laravel;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\System\Tests\Base\SystemTestCase;
use stdClass;

class CollectionTest extends SystemTestCase
{

    public function testFilter(): void
    {
        $accountIds = [1, 2, 3, 4, 5];
        $accountIds = collect($accountIds)->filter(function ($id) {
            return $id !== 4;
        });
        $this->assertCount(4, $accountIds);
    }


    public function testCollect(): void
    {
        $collect = collect([1, 2, 3, 4, 5]);
        $items   = collect($collect)->values()->toArray();
        $this->assertCount(5, $items);
    }


    public function testToArray(): void
    {
        // collect 内部可以转换成数组
        $collect    = collect([1, 2, 3, 4]);
        $colCollect = collect([$collect, $collect, $collect]);
        $this->assertIsArray($colCollect->toArray()[0]);

        // collect
        $std    = new stdClass();
        $colStd = collect([$std, $std, $std]);
        $this->assertIsObject($colStd->toArray()[0]);
    }

    /**
     * Group 没有值也可以进行筛选
     */
    public function testNoGroup(): void
    {
        $items = collect([
            [
                'item'  => 'g1',
                'group' => 'g',
            ],
            [
                'item'  => 'g2',
                'group' => 'g',
            ],
            [
                'item' => 'e1',
            ],
            [
                'item' => 'e2',
            ],
        ]);

        $ias = $items->where('group', '!=', '');
        $this->assertCount(2, $ias);
    }
}