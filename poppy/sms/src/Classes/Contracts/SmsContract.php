<?php

namespace Poppy\Sms\Classes\Contracts;

/**
 * 短信实现
 */
interface SmsContract
{
    /**
     * 发送短信
     * @param string       $type    发送类型
     * @param array|string $mobiles 接收手机号
     * @param array        $params  参数
     * @return mixed
     */
    public function send(string $type, $mobiles, array $params = []): bool;
}