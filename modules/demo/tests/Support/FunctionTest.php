<?php namespace Poppy\Demo\Tests\Support;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\Framework\Application\TestCase;

class FunctionTest extends TestCase
{
    /**
     * 测试 oss 上传
     */
    public function testSysDb(): void
    {
        $comment = sys_db('poppy_demo.is_open');
        $this->assertEquals('是否开启', $comment, 'Db Comment Fetch failed.');
    }
}
