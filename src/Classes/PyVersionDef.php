<?php

declare(strict_types = 1);

namespace Poppy\Version\Classes;

class PyVersionDef
{
    /**
     * 当前最大版本号缓存
     * @return string
     */
    public static function ckTagMaxVersion(): string
    {
        return 'py-version:max-version';
    }
}