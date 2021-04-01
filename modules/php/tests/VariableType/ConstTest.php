<?php

namespace Php\Tests\VariableType;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Framework\Application\TestCase;

class ConstTest extends TestCase
{
    /**
     * PhpVersion >= 7.4
     */
    public function testPhpVersion(): void
    {
        $this->assertGreaterThanOrEqual(70400, PHP_VERSION_ID);
    }
}