<?php

namespace Poppy\Sms\Services;

use Poppy\Core\Services\Contracts\ServiceArray;
use Poppy\Sms\Classes\AliyunSmsProvider;
use Poppy\Sms\Http\Forms\Settings\FormSettingAliyun;

class SendTypeAliyun implements ServiceArray
{

    public function key(): string
    {
        return 'aliyun';
    }

    public function data()
    {
        return [
            'title'    => '阿里云',
            'provider' => AliyunSmsProvider::class,
            'setting'  => FormSettingAliyun::class,
            'route'    => 'py-sms:backend.store.aliyun',
        ];
    }
}