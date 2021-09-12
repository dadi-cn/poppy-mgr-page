<?php namespace Poppy\Sms\Tests;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Support\Str;
use Poppy\Sms\Action\Sms;
use Poppy\Sms\Classes\Contracts\SmsContract;
use Poppy\System\Tests\Base\SystemTestCase;

/**
 * 发送短信
 */
class LocalTest extends SystemTestCase
{

    public function setUp(): void
    {
        parent::setUp();
        config([
            'poppy.sms.send_type' => Sms::SCOPE_LOCAL,
        ]);
    }

    /**
     * 测试短信发送
     */
    public function testCaptcha(): void
    {
        $Sms = app('poppy.sms');
        if ($Sms->send('captcha', '15254109156', [
            'code' => 'Test_' . Str::random(4),
        ])) {
            $this->assertTrue(true);
        }
        else {
            $this->assertTrue(false, $Sms->getError());
        }
    }

    public function testContract()
    {
        $Sms = app(SmsContract::class);
        if ($Sms->send('captcha', '15254109156', [
            'code' => 'Test_' . Str::random(4),
        ])) {
            $this->assertTrue(true);
        }
        else {
            $this->assertTrue(false, $Sms->getError());
        }
    }
}