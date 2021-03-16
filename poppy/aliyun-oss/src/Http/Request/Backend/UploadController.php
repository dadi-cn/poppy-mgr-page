<?php

namespace Poppy\AliyunOss\Http\Request\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Poppy\AliyunOss\Http\Forms\Settings\FormSettingAliyunOss;
use Poppy\Framework\Classes\Resp;
use Poppy\MgrPage\Http\Request\Backend\BackendController;
use Poppy\System\Classes\Layout\Content;

/**
 * Aliyun 上传配置
 */
class UploadController extends BackendController
{

    public function __construct()
    {
        parent::__construct();

        self::$permission = [
            'global' => 'backend:py-system.global.manage',
        ];
    }

    /**
     * 保存邮件配置
     * @return array|JsonResponse|RedirectResponse|Response|Redirector|Resp|Content|\Response
     */
    public function store()
    {
        return (new Content())->body(new FormSettingAliyunOss());
    }
}
