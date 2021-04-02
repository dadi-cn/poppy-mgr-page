<?php

namespace Poppy\Sms\Classes;

use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Sms\Classes\Chuanglan\SmsApi;
use Poppy\Sms\Classes\Contracts\SmsContract;

class ChuanglanSms extends BaseSms implements SmsContract
{
    use AppTrait;

    public $api_account;

    public $api_password;

    /** @var SmsApi */
    public $clapi;

    /**
     * ChuanglanSms constructor.
     */
    public function __construct()
    {
        $this->initClient();
    }

    /**
     * @inheritDoc
     */
    public function send(string $type, $mobiles, array $params = [], $sign = ''): bool
    {
        if (!$this->checkSms($mobiles, $type, $sign)) {
            return false;
        }

        // 拼接签名
        $msg = '【' . trim(trim($this->sign, '【'), '】') . '】' . $this->sms['code'];

        $result = $this->clapi->sendSms($mobiles, $msg);
        if (!is_null($result)) {
            $output = json_decode($result, true);
            if (isset($output['code']) && $output['code'] === '0') {
                return true;
            }

            return $this->setError($result);
        }

        return $this->setError($result);
    }

    /**
     * 初始化
     */
    private function initClient()
    {
        $this->api_account  = config('poppy.sms.chuanglan.access_key');
        $this->api_password = config('poppy.sms.chuanglan.access_secret');
        $this->clapi        = new SmsApi($this->api_account, $this->api_password);
    }
}
