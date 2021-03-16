<?php

namespace Poppy\AliyunPush\Tests\Push;


use Notification;
use Poppy\AliyunPush\Classes\BindTag;
use Poppy\AliyunPush\Tests\Sample\AndroidMessageNotification;
use Poppy\AliyunPush\Tests\Sample\AndroidNoticeNotification;
use Poppy\AliyunPush\Tests\Sample\IosMessageNotification;
use Poppy\AliyunPush\Tests\Sample\IosNoticeNotification;
use Poppy\AliyunPush\Tests\Sample\IosTagBoyPushNotification;
use Poppy\AliyunPush\Tests\Sample\IosTagGirlPushNotification;
use Poppy\AliyunPush\Tests\Sample\IosTagIosPushNotification;
use Poppy\Framework\Application\TestCase;
use Throwable;

/**
 * 推送测试
 */
class PushTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        $filePath = dirname(__DIR__) . '/config/account.huowan.json';
        $config   = file_get_contents($filePath);
        $arrConf  = json_decode($config, true);

        // config
        config([
            'poppy.aliyun-push.access_key'       => $arrConf['access_key'],
            'poppy.aliyun-push.access_secret'    => $arrConf['access_secret'],
            'poppy.aliyun-push.android_app_key'  => $arrConf['android_app_key'],
            'poppy.aliyun-push.ios_app_key'      => $arrConf['ios_app_key'],
            'poppy.aliyun-push.android_channel'  => $arrConf['android_channel'],
            'poppy.aliyun-push.ios_is_open'      => $arrConf['ios_is_open'],
            'poppy.aliyun-push.android_is_open'  => $arrConf['android_is_open'],
            'poppy.aliyun-push.registration_ids' => $arrConf['registration_ids'],
        ]);
    }

    public function testSendAndroidNotice()
    {
        try {
            Notification::send(null, new AndroidNoticeNotification());
            $this->assertTrue(true);
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testSendAndroidMessage()
    {
        try {
            Notification::send(null, new AndroidMessageNotification());
            $this->assertTrue(true);
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testSendIosNotice()
    {
        try {
            Notification::send(null, new IosNoticeNotification());
            $this->assertTrue(true);
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testSendIosMessage()
    {
        try {
            Notification::send(null, new IosMessageNotification());
            $this->assertTrue(true);
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    /**
     * 绑定倩倩的设备号设定标签为 girl
     */
    public function testBindGirl()
    {
        try {
            $Bind = new BindTag();
            $qqId = 'a6e8a2f36e2d4da9a22762362a987476';
            $dyId = 'd733ae6c57754f22a4de519e0eafe816';
            $zxId = 'b59f5b4cfc764599843f277e1a092adb';
            $Bind->bindDevice(BindTag::DEVICE_TYPE_IOS, 'girl', $qqId); // 倩倩
            $Bind->bindDevice(BindTag::DEVICE_TYPE_IOS, 'boy', $zxId);  // 张新
            $Bind->bindDevice(BindTag::DEVICE_TYPE_IOS, 'boy', $dyId);  // 赵殿有
            $Bind->bindDevice(BindTag::DEVICE_TYPE_IOS, 'ios', $qqId);
            $Bind->bindDevice(BindTag::DEVICE_TYPE_IOS, 'ios', $zxId);
            $Bind->bindDevice(BindTag::DEVICE_TYPE_IOS, 'ios', $dyId);
            $this->assertTrue(true);
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testSendIosTagGirl()
    {
        try {
            Notification::send(null, new IosTagGirlPushNotification());
            $this->assertTrue(true);
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testSendIosTagIosPush()
    {
        try {
            Notification::send(null, new IosTagIosPushNotification());
            $this->assertTrue(true);
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }

    public function testSendIosTagBoyPush()
    {
        try {
            Notification::send(null, new IosTagBoyPushNotification());
            $this->assertTrue(true);
        } catch (Throwable $e) {
            $this->assertTrue(false, $e->getMessage());
        }
    }
}