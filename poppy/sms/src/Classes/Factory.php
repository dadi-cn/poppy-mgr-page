<?php

namespace Poppy\Sms\Classes;

use Illuminate\Support\Str;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Sms\Classes\Contracts\SmsContract;
use SimpleXMLElement;

class Factory
{

    private static $instance;

    /**
     * @return mixed|SimpleXMLElement
     */
    public static function instance(): BaseSms
    {
        if (!self::$instance) {
            $sendType = config('poppy.sms.send_type') ?: 'local';
            $class    = __NAMESPACE__ . '\\' . Str::studly($sendType) . 'Sms';
            /** @var SmsContract|AppTrait $Sms */
            self::$instance = new $class();
        }
        return self::$instance;
    }
}
