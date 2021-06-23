<?php

declare(strict_types = 1);

namespace Poppy\AliyunPush\Contracts;

interface AliPushChannel
{
    /**
     * @return mixed
     */
    public function toAliPush();
}