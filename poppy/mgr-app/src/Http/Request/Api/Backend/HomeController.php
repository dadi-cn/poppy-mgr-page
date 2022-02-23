<?php

namespace Poppy\MgrApp\Http\Request\Api\Backend;

use Poppy\MgrApp\Http\Forms\MgrAppSettings\SettingUpload;
use Poppy\MgrApp\Widgets\SettingWidget;

/**
 * 用户
 */
class HomeController extends BackendController
{
    /**
     * Setting
     * @param string     $path 地址
     */
    public function setting(string $path = 'poppy.system')
    {
        $Setting = new SettingWidget();
        return $Setting->resp($path);
    }

    public function upload()
    {
        $Setting = new SettingUpload();
        return $Setting->resp();
    }
}