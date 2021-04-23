<?php

namespace Poppy\Sms\Classes;

use Poppy\Sms\Classes\Chuanglan\SmsApi;
use Poppy\Sms\Classes\Contracts\SmsContract;
use Poppy\System\Classes\Passport\MobileCty;

class ChuanglanSms extends BaseSms implements SmsContract
{

    /** @var SmsApi */
    private $clApi;

    /**
     * clSms constructor.
     */
    public function __construct()
    {
        $apiAccount  = config('poppy.sms.chuanglan.access_key');
        $apiPassword = config('poppy.sms.chuanglan.access_secret');
        $this->clApi = new SmsApi($apiAccount, $apiPassword);
    }

    /**
     * @inheritDoc
     */
    public function send(string $type, $mobiles, array $params = [], $sign = ''): bool
    {
        if (!$this->checkSms($mobiles, $type, $sign)) {
            return false;
        }

        // 如果是86 改为1xxx
        if (is_array($mobiles)) {
            $mobiles = MobileCty::passportMobile(implode(',', $mobiles));
        }
        $mobiles = MobileCty::passportMobile($mobiles);

        $msg = sys_trans($this->sms['code'], $params);
        // 拼接签名
        $msg = '【' . trim(trim($this->sign, '【'), '】') . '】' . $msg;

        $result = $this->clApi->sendSms($mobiles, $msg);
        if (!is_null($result)) {
            $output = json_decode($result, true);
            if (isset($output['code']) && $output['code'] === '0') {
                return true;
            }

            return $this->setError($result);
        }

        return $this->setError($result);
    }
}
