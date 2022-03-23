<?php

namespace Php\Tests\VariableType;

use Poppy\Framework\Application\TestCase;

class ScalarTest extends TestCase
{
    public function testIsArray(): void
    {
        $array = (array) 5;
        $this->assertEquals([5], $array);

        $array = [5];
        $this->assertEquals([5], $array);
    }


    public function testOr()
    {
        $or = 'test' || 'error';
        $this->assertEquals(true, $or);
    }
}
