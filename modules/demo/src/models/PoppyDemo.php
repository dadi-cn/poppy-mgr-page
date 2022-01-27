<?php

namespace Demo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Poppy\System\Models\PamAccount;

/**
 * \Poppy\PoppyCoreDemo
 *
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

    public function pam()
    {
        return $this->hasOne(PamAccount::class, 'id', 'account_id');
    }
}