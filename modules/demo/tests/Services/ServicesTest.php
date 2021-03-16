<?php namespace Poppy\Demo\Tests\Services;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Core\Services\Factory\ServiceFactory;
use Poppy\Framework\Application\TestCase;
use Poppy\Framework\Exceptions\ApplicationException;
use Throwable;

class ServicesTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        sys_cache('py-core')->forget('module.repo.hooks');
        sys_cache('py-core')->forget('module.repo.module');
    }

    public function testParse()
    {
        try {
            $html = (new ServiceFactory())->parse('poppy.demo.html_demo');
            $this->assertEquals('<div></div>', $html);
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testSysHook(): void
    {
        // 数组
        try {
            $arrDemo = sys_hook('poppy.demo.array_demo');
            $this->assertArrayHasKey('poppy-core-array-service', $arrDemo);
        } catch (ApplicationException $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }
}
