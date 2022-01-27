<?php

namespace Php\Tests\Math;

use Poppy\Framework\Application\TestCase;

class MathTest extends TestCase
{
    /**
     * 文字长度处理
     */
    public function testRand(): void
    {
        for ($i = 0; $i < 100; $i++) {
            dump(mt_rand(0, 10000) / 100);
        }
    }

}