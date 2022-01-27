<?php

namespace Php\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property int    $id
 * @property string $title   问题内容
 */
class PhpDemo extends Model
{

    public $timestamps = false;
    protected $table = 'php_demo';
    protected $fillable = [
        'id',
        'title',
    ];
}
