<?php

namespace Php\Tests\Laravel;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Support\Str;
use Poppy\System\Tests\Base\SystemTestCase;

class StrTest extends SystemTestCase
{
    /**
     * Diff 测试
     */
    public function testCaseConvert(): void
    {
        $normal = 'api_v1';
        $studly = Str::studly($normal);
        $this->assertEquals('ApiV1', $studly);
    }

    /**
     * 截取字符
     */
    public function testCut(): void
    {
        $code = 'voice:' . md5('8') . '.mp3';
        $this->assertEquals('voice', Str::before($code, ':'));
    }

    public function testSnakeCase()
    {
        $name = 'AppV2';
        $this->assertEquals('app_v2', Str::snake($name));

        $name = 'EventRun';
        $this->assertEquals('event_run', Str::snake($name));

        $name = 'EventRunEvent';
        $this->assertEquals('event_run_event', Str::snake($name));
    }
}