<?php

namespace Php\Tests\ControlStructure;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\System\Tests\Base\SystemTestCase;

class WhileTest extends SystemTestCase
{
    public function testDecrease()
    {
        $f         = 5;
        $loopTimes = 0;

        while ($f--) {
            $loopTimes++;
        }
        $this->assertEquals(5, $loopTimes);

        // 这里执行到 -1
        $this->assertEquals(-1, $f);

        $f         = 5;
        $loopTimes = 0;
        while ($f) {
            $f--;
            $loopTimes++;
        }
        $this->assertEquals(5, $loopTimes);

    }
}