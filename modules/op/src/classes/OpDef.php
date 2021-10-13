<?php

namespace Op\Classes;

/**
 * 本地的 CK 定义
 */
class OpDef
{
    /**
     * 邮件内容组
     * @param string $type
     * @return string
     */
    public static function ckMailGroup(string $type): string
    {
        return 'op:mail-group-' . $type;
    }
}