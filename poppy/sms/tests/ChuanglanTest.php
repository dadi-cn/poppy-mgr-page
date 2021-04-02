<?php

namespace Poppy\Sms\Tests;

/**
 * Copyright (C) Update For IDE
 */

use Illuminate\Support\Str;
use Poppy\Sms\Action\Sms;
use Poppy\System\Tests\Base\SystemTestCase;

/**
 * 发送短信
 */
class ChuanglanTest extends SystemTestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $arrConf = $this->readJson('poppy.sms', 'tests/config/account.json');
        // config
        config([
            'poppy.sms.send_type'               => Sms::SCOPE_CHUANGLAN,
            'poppy.sms.chuanglan.access_key'    => $arrConf['chuanglan_access_key'],
            'poppy.sms.chuanglan.access_secret' => $arrConf['chuanglan_access_secret'],
        ]);
    }

    /**
     * 测试短信发送
     */
    public function testCaptcha(): void
    {
        $Sms = app('poppy.sms');
        if ($Sms->send('captcha', '15931012793', [
            'code' => 'Test_' . Str::random(4),
        ], '')) {
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
        if ($Sms->send('handle', '15931012793')) {
            $this->assertTrue(true);
        }
        else {
            $this->assertTrue(false, $Sms->getError());
        }
    }
}