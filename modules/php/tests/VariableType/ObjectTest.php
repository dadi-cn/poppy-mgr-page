<?php

namespace Php\Tests\VariableType;

use Php\Classes\CaseClass;
use Poppy\Framework\Application\TestCase;

class ObjectTest extends TestCase
{
    public function testSetGet(): void
    {
        $set = (new CaseClass())->getset();
        $this->assertEquals('getSet', $set);
    }
}