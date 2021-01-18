<?php namespace Poppy\AliyunPush\Services;

use Poppy\AliyunPush\Forms\Settings\FormSettingAliyunPush;
use Poppy\Core\Services\Contracts\ServiceArray;

class SettingAliyunPush implements ServiceArray
{

    /**
     * @return mixed
     */
    public function key()
    {
        return 'poppy.aliyun-push';
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return [
            'title' => '阿里云推送',
            'forms' => [
                FormSettingAliyunPush::class,
            ],
        ];
    }
}