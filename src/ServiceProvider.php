<?php namespace Poppy\Sms;

use Illuminate\Support\Str;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Exceptions\ModuleNotFoundException;
use Poppy\Framework\Support\PoppyServiceProvider as ModuleServiceProviderBase;
use Poppy\Sms\Action\Sms;
use Poppy\Sms\Classes\Contracts\SmsContract;
use Poppy\Sms\Exceptions\SmsException;
use Poppy\Sms\Http\RouteServiceProvider;

class ServiceProvider extends ModuleServiceProviderBase
{
    /**
     * @var string 模块标识
     */
    protected $name = 'poppy.sms';

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
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->registerConfig();

        // 配置文件
        $this->mergeConfigFrom(dirname(__DIR__) . '/resources/config/sms.php', 'poppy.sms');

        $this->app->singleton('poppy.sms', function () {
            $sendType = config('poppy.sms.send_type') ?: 'local';
            $class    = 'Poppy\\Sms\\Classes\\' . Str::studly($sendType) . 'Sms';
            if (!class_exists($class)) {
                throw new SmsException('短信设置类型错误, 请重新设置, 当前类型为 : ' . $sendType);
            }
            /** @var SmsContract|AppTrait $Sms */
            return new $class();
        });

        $this->app->alias('poppy.sms', SmsContract::class);
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return [
            'poppy.sms',
        ];
    }


    private function registerConfig()
    {
        // 注册配置
        if (sys_setting('py-sms::sms.send_type')) {
            // config 注入
            config([
                'poppy.sms.send_type'      => sys_setting('py-sms::sms.send_type'),
                'poppy.sms.sign'           => sys_setting('py-sms::sms.sign'),
                'poppy.sms.expired_minute' => sys_setting('py-sms::sms.expired_minute'),
            ]);
        }

        if (sys_setting('py-sms::sms.send_type') === Sms::SCOPE_ALIYUN) {
            config([
                'poppy.sms.aliyun.access_key'    => sys_setting('py-sms::sms.aliyun_access_key'),
                'poppy.sms.aliyun.access_secret' => sys_setting('py-sms::sms.aliyun_access_secret'),
            ]);
        }
    }
}
