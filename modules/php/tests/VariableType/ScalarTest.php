<?php

namespace Php\Tests\Ability\Core;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Framework\Application\TestCase;
use Poppy\System\Tests\Ability\Jobs\StaticVarJob;

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
