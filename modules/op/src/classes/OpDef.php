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

    /**
     * 用户角色缓存
     * @param $id
     * @param $type
     * @return string
     */
    public static function ckQqKoa($id, $type): string
    {
        return 'op:qq-koa-' . $id . ':' . $type;
    }
}