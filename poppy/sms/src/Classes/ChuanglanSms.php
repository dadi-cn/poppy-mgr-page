<?php

namespace Poppy\Sms\Classes;

use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Sms\Classes\Contracts\SmsContract;
use Poppy\Sms\Exceptions\SmsException;
use SimpleXMLElement;

class ChuanglanSms extends BaseSms implements SmsContract
{
    use AppTrait;

    /**
     * AliyunSms constructor.
     * @throws SmsException
     */
    public function __construct()
    {
        $this->initClient();
    }

    /**
     * @param string       $type    模版代码
     * @param array|string $mobiles 手机号码
     * @param array        $params  额外参数
     * @return mixed|SimpleXMLElement
     */
    public function send(string $type, $mobiles, array $params = []): bool
    {

    }

    /**
     * 初始化
     */
    private function initClient()
    {

    }
}
