<?php

declare(strict_types = 1);

namespace Php\Channels;

use Illuminate\Notifications\Notification;
use Poppy\AliyunPush\Contracts\AliPushChannel as AliPushChannelContract;

/**
 * 阿里推送频道
 */
class PhpChannel
{
    /**
     * Send the given notification.
     * @param mixed                               $notifiable
     * @param Notification|AliPushChannelContract $notification
     */
    public function send($notifiable, Notification $notification)
    {
        sys_debug('php', __CLASS__, 'Send At Php Channel');
    }
}