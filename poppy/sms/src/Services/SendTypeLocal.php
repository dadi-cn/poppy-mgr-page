<?php

namespace Poppy\Sms\Services;

use Poppy\Core\Services\Contracts\ServiceArray;
use Poppy\Sms\Classes\LocalSmsProvider;

class SendTypeLocal implements ServiceArray
{

    public function key(): string
    {
        return 'local';
    }

    public function data()
    {
        return [
            'title'    => '本地',
            'provider' => LocalSmsProvider::class,
        ];
    }
}