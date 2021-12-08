<?php

namespace Php\Models;

use Eloquent;

/**
 *
 * @property int    $id
 * @property string $title   问题内容
 * @mixin Eloquent
 */
class PhpDemo extends Eloquent
{

    public $timestamps = false;
    protected $table = 'php_demo';
    protected $fillable = [
        'id',
        'title',
    ];
}
