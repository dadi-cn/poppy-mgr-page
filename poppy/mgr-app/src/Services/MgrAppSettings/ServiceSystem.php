<?php

namespace Poppy\MgrApp\Services\MgrAppSettings;

use Poppy\Core\Services\Contracts\ServiceArray;
use Poppy\MgrApp\Http\Forms\MgrAppSettings\SettingPam;
use Poppy\MgrApp\Http\Forms\MgrAppSettings\SettingSite;
use Poppy\MgrApp\Http\Forms\MgrAppSettings\SettingUpload;

class ServiceSystem implements ServiceArray
{

    public function key(): string
    {
        return 'poppy.system';
    }

    public function data(): array
    {
        return [
            'title' => '系统',
            'forms' => [
                SettingSite::class,
                SettingPam::class,
                SettingUpload::class,
            ],
        ];
    }
}