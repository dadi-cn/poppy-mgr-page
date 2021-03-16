<?php

namespace Demo\Models;

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
/*
 * This is NOT a Free software.
 * When you have some Question or Advice can contact Me.
 * @author     Duoli <zhaody901@126.com>
 * @copyright  Copyright (c) 2013-2021 Poppy Team
 */

