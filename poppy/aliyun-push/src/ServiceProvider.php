<?php

namespace Poppy\AliyunPush;

use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;

class ServiceProvider extends ModuleServiceProviderBase
{
    /**
     * @var string 模块标识
     */
    protected $name = 'poppy.aliyun-push';

    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     * @return void
     * @throws ModuleNotFoundException
     */
    public function boot()
    {
        parent::boot($this->name);

        $this->bootConfig();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        // 配置文件
        $this->mergeConfigFrom(dirname(__DIR__) . '/resources/config/aliyun-push.php', 'poppy.aliyun-push');
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return [];
    }


    private function bootConfig()
    {
        // 注册配置
        if (function_exists('sys_setting') && sys_setting('py-aliyun-push::push.access_key')) {
            // config 注入
            config([
                'poppy.aliyun-push.access_key'       => sys_setting('py-aliyun-push::push.access_key'),
                'poppy.aliyun-push.access_secret'    => sys_setting('py-aliyun-push::push.access_secret'),
                'poppy.aliyun-push.ios_is_open'      => sys_setting('py-aliyun-push::push.ios_is_open'),
                'poppy.aliyun-push.ios_app_key'      => sys_setting('py-aliyun-push::push.ios_app_key'),
                'poppy.aliyun-push.android_is_open'  => sys_setting('py-aliyun-push::push.android_is_open'),
                'poppy.aliyun-push.android_app_key'  => sys_setting('py-aliyun-push::push.android_app_key'),
                'poppy.aliyun-push.android_channel'  => sys_setting('py-aliyun-push::push.android_channel'),
                'poppy.aliyun-push.android_activity' => sys_setting('py-aliyun-push::push.android_activity'),
            ]);
        }
    }
}
