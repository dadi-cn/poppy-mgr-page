<?php

namespace Poppy\Sms\Classes;

use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Sms\Action\Sms;

abstract class BaseSms
{
    use AppTrait;

    /**
     * @var array 短信
     */
    protected $sms;

    /**
     * 检查短信是否为空
     * @param string       $type   类型
     * @param string|array $mobile 手机号
     * @return bool
     */
    public function checkSms($mobile, string $type): bool
    {
        if (!$mobile) {
            return $this->setError('手机号缺失, 不进行发送!');
        }

        if (!$type) {
            return $this->setError('短信类型不存在, 不进行发送');
        }
        $this->sms = Sms::smsTpl($type);

        if (!$this->sms) {
            return $this->setError('请设置短信模板');
        }

        return true;
    }
}
