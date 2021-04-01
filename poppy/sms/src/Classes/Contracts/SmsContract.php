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
     * @param string       $sign    签名, 不填写使用默认签名
     * @return mixed
     */
    public function send(string $type, $mobiles, array $params = [], $sign = ''): bool;
}