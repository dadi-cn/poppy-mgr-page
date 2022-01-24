<?php

namespace Php\Tests\VariableType;

/**
 * Copyright (C) Update For IDE
 */

use Php\Classes\VariableType\ClassChainDemo;
use Poppy\Framework\Application\TestCase;

class ClassTest extends TestCase
{
    /**
     * 文字长度处理
     */
    public function testChain()
    {
        $name = (new ClassChainDemo())->setName('duoli')->name();
        $this->assertEquals('duoli', $name);
    }
}