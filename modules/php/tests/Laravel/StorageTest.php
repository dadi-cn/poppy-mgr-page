<?php

namespace Php\Tests\Laravel;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\System\Tests\Base\SystemTestCase;
use Storage;

class StorageTest extends SystemTestCase
{
	public function testSize(): void
	{
		$disk = Storage::disk('storage');
		$size = $disk->size('sami/sami.phar');
		$this->assertIsInt($size);
	}
}