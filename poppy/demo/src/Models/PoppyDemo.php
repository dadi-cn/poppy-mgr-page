<?php namespace Poppy\Demo\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * \Poppy\Core\Models\PoppyCoreDemo
 *
 * @mixin Eloquent
 * @property int         $id
 * @property int         $is_open 是否开启
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class PoppyDemo extends Model
{
    // change tablename
    protected $table = 'poppy_demo';

    protected $fillable = [
        // fillable
    ];

}
