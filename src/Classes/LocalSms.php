<?php namespace Poppy\Sms\Classes;

use Log;
use Poppy\Sms\Classes\Contracts\SmsContract;
use SimpleXMLElement;

/**
 * 本地发送短信, 记录在日志中
 */
class LocalSms extends BaseSms implements SmsContract
{

    /**
     * @param string       $type    模版代码
     * @param array|string $mobiles 手机号码
     * @param array        $params  额外参数
     * @return mixed|SimpleXMLElement
     */
    public function send(string $type, $mobiles, array $params = []): bool
    {
        if (!$this->checkSms($mobiles, $type)) {
            return false;
        }
        // 未选择则使用日志, 线上不记录日志
        $sign    = config('poppy.sms.sign');
        $trans   = sys_trans($this->sms['content'], $params);
        $content = ($sign ? "[{$sign}]" : '') . $trans;
        Log::info(sys_mark('poppy.sms', self::class, $content, true));

        return true;
    }
}
