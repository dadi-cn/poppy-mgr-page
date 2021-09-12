<?php

namespace Poppy\SensitiveWord\Models;

use Eloquent;

/**
 * 地区表
 *
 * @property int    $id
 * @property string $word      文字
 * @mixin Eloquent
 */
class SysSensitiveWord extends Eloquent
{

    public $timestamps = false;

    protected $table = 'sys_sensitive_word';

    protected $fillable = [
        'word',
    ];
}