<?php

namespace Poppy\Sms\Classes;

use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Sms\Classes\Contracts\SmsContract;
use SimpleXMLElement;

class Factory
{

    /**
     * @var SmsContract
     */
    private static $instance;

    /**
     * @return mixed|SimpleXMLElement
     * @throws ApplicationException
     */
    public static function instance(): BaseSms
    {
        if (!self::$instance) {
            $sendType = sys_setting('py-sms::sms.send_type');
            $hooks    = sys_hook('poppy.sms.send_type');
            if (!$sendType) {
                $sendType = 'local';
            }
            $sender      = $hooks[$sendType];
            $senderClass = $sender['provider'] ?? LocalSmsProvider::class;
            /** @var SmsContract|AppTrait $Sms */
            self::$instance = new $senderClass();
        }
        return self::$instance;
    }
}
