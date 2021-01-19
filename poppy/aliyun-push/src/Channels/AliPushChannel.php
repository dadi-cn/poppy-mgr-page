<?php namespace Poppy\AliyunPush\Channels;

use Illuminate\Notifications\Notification;
use Poppy\AliyunPush\Classes\AliPush;
use Poppy\AliyunPush\Classes\Config\Config;
use Poppy\AliyunPush\Contracts\AliPushChannel as AliPushChannelContract;
use Poppy\AliyunPush\Exceptions\PushException;


/**
 * 阿里推送频道
 */
class AliPushChannel
{
    /**
     * Send the given notification.
     * @param mixed                               $notifiable
     * @param Notification|AliPushChannelContract $notification
     * @throws PushException
     */
    public function send($notifiable, Notification $notification)
    {
        $notify = $notification->toAliPush();
        if (!$notify) {
            return;
        }
        $androidAppKey  = config('poppy.aliyun-push.android_app_key');
        $iosAppKey      = config('poppy.aliyun-push.ios_app_key');
        $androidChannel = config('poppy.aliyun-push.android_channel');
        $accessKey      = config('poppy.aliyun-push.access_key');
        $accessSecret   = config('poppy.aliyun-push.access_secret');
        $config         = new Config($accessKey, $accessSecret, $androidAppKey, $androidChannel, $iosAppKey);
        $Push           = AliPush::getInstance()->setConfig($config);
        if (!$Push->send($notify)) {
            sys_error('poppy.aliyun-push.error', self::class, [
                'error'  => (string) $Push->getError(),
                'notify' => $notify,
            ]);
        }
    }
}