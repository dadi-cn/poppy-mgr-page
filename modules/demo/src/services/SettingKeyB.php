<?php

namespace Demo\Services;

use Poppy\Core\Services\Contracts\ServiceArray;
use Poppy\System\Http\Forms\Settings\FormSettingPam;
use Poppy\System\Http\Forms\Settings\FormSettingSite;

class SettingKeyB implements ServiceArray
{

    public function key(): string
    {
        return 'demo.key-b';
    }

    public function data()
    {
        return [
            'title' => 'KEY-B',
            'forms' => [
                FormSettingPam::class,
            ],
        ];
    }
}