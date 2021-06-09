<?php

namespace Demo\Services;

use Poppy\Core\Services\Contracts\ServiceArray;
use Poppy\System\Http\Forms\Settings\FormSettingSite;

class SettingKeyA implements ServiceArray
{

    public function key(): string
    {
        return 'demo.key-a';
    }

    public function data()
    {
        return [
            'title' => 'KEY-A',
            'group' => 'key-a',
            'forms' => [
                FormSettingSite::class,
            ],
        ];
    }
}