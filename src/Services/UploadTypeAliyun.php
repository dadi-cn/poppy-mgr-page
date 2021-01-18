<?php namespace Poppy\AliyunOss\Services;

use Poppy\AliyunOss\Action\OssDefaultUploadProvider;
use Poppy\AliyunOss\Http\Forms\Settings\FormSettingAliyunOss;
use Poppy\Core\Services\Contracts\ServiceArray;

class UploadTypeAliyun implements ServiceArray
{

    /**
     * @return mixed
     */
    public function key()
    {
        return 'aliyun';
    }

    /**
     * @return mixed
     */
    public function data()
    {
        return [
            'title'    => '阿里云存储(Oss)',
            'provider' => OssDefaultUploadProvider::class,
            'setting'  => FormSettingAliyunOss::class,
            'route'    => 'py-aliyun-oss:backend.upload.store',
        ];
    }
}