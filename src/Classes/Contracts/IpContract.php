<?php namespace Poppy\Extension\IpStore\Classes\Contracts;

interface IpContract
{
    /**
     * 获取地址信息, 中文
     * @param string $ip
     * @return string
     */
    public function area(string $ip);
}
