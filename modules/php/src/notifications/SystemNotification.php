<?php


namespace Php\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Php\Channels\PhpChannel;

/**
 * 订单相关的系统通知
 */
class SystemNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable): array
    {
        return [PhpChannel::class,];
    }

    public function toPhpChannel()
    {
        return [];
    }
}
