<?php

namespace Poppy\Sms\Classes;

use Log;
use Poppy\Sms\Classes\Contracts\SmsContract;

/**
 * 本地发送短信, 记录在日志中
 */
class LocalSms extends BaseSms implements SmsContract
{

    /**
     * @inheritDoc
     */
    public function send(string $type, $mobiles, array $params = [], $sign = ''): bool
    {
        if (!$this->checkSms($mobiles, $type, $sign)) {
            return false;
        }
        // 未选择则使用日志, 线上不记录日志
        $sign    = $this->sign;
        $trans   = sys_trans($this->sms['code'], $params);
        $content = ($sign ? "[{$sign}]" : '') . $trans;
        Log::info(sys_mark('poppy.sms', self::class, $content, true));

        return true;
    }
}
