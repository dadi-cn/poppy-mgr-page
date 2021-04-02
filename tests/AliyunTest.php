<?php

namespace Poppy\Sms\Tests;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Support\Str;
use Poppy\Sms\Action\Sms;

/**
 * 发送短信
 */
class AliyunTest extends BaseSms
{

    public function setUp(): void
    {
        parent::setUp();

        // config
        config([
            'poppy.sms.send_type'            => Sms::SCOPE_ALIYUN,
            'poppy.sms.aliyun.access_key'    => data_get($this->conf, 'aliyun_access_key'),
            'poppy.sms.aliyun.access_secret' => data_get($this->conf, 'aliyun_access_secret'),
        ]);
    }

    /**
     * 测试短信发送
     */
    public function testCaptcha(): void
    {
        $Sms = app('poppy.sms');
        if ($Sms->send('captcha', $this->mobile, [
            'code' => 'Test_' . Str::random(4),
        ])) {
            $this->assertTrue(true);
        }
        else {
            $this->assertTrue(false, $Sms->getError());
        }
    }

    /**
     * 测试短信发送
     */
    public function testHandle(): void
    {
        $Sms = app('poppy.sms');
        if ($Sms->send('handle', $this->mobile)) {
            $this->assertTrue(true);
        }
        else {
            $this->assertTrue(false, $Sms->getError());
        }
    }
}