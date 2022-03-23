<?php

declare(strict_types=1);

namespace Poppy\AliyunPush\Services;

use Poppy\AliyunPush\Forms\Settings\FormSettingAliyunPush;
use Poppy\Core\Services\Contracts\ServiceArray;

class SettingAliyunPush implements ServiceArray
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
                FormSettingAliyunPush::class,
            ],
        ];
    }
}