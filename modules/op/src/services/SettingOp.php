<?php namespace Op\Services;

use Op\Http\Forms\Settings\FormSettingOp;
use Poppy\Core\Services\Contracts\ServiceArray;

class SettingOp implements ServiceArray
{

    public function key():string
    {
        return 'op';
    }

    public function data():array
    {
        return [
            'title' => '运维',
            'forms' => [
                FormSettingOp::class,
            ],
        ];
    }
}