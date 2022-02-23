<?php

declare(strict_types=1);

namespace Poppy\AliyunPush\Services\MgrAppSettings;

use Poppy\AliyunPush\Forms\MgrAppSettings\SettingAliyunPush;
use Poppy\Core\Services\Contracts\ServiceArray;

class ServiceAliyunPush implements ServiceArray
{
    public function key(): string
    {
        return 'poppy.aliyun-push';
    }

    public function data(): array
    {
        return [
            'title' => '阿里云推送',
            'forms' => [
                SettingAliyunPush::class,
            ],
        ];
    }
}