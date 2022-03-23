<?php

namespace Poppy\SensitiveWord\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 地区表
 *
 * @property int    $id
 * @property string $word      文字
 */
class SysSensitiveWord extends Model
{

    public $timestamps = false;

    protected $table = 'sys_sensitive_word';

    protected $fillable = [
        'word',
    ];
}