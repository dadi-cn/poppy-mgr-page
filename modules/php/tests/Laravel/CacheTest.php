<?php

namespace Php\Tests\Laravel;


use Poppy\Framework\Application\TestCase;

class CacheTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSet()
    {
        app('cache')->tags('poppy-core')->remember('module-php:test-cache-set', 50, function () {
            return '*';
        });
        app('cache')->tags('poppy-core')->flush();
        $this->assertNull(app('cache')->tags('poppy-core')->get('module-php:test-cache-set'));
    }
}