<?php namespace Op\Services;

use Op\Http\Forms\Settings\FormSettingOp;
use Poppy\Core\Services\Contracts\ServiceArray;

class SettingOp implements ServiceArray
{

    /**
     * @return mixed
     */
    public function key()
    {
        return 'op';
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return [
            'title' => '运维',
            'forms' => [
                FormSettingOp::class,
            ],
        ];
    }
}