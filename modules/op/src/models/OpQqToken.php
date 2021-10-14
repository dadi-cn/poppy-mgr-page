<?php

namespace Op\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * \Op\Models\OpQqToken
 *
 * @property int         $id
 * @property string      $appid        Appid , 用来区分王者/和平
 * @property string      $open_id      OPEN ID
 * @property string      $access_token Access Token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|OpQqToken newModelQuery()
 * @method static Builder|OpQqToken newQuery()
 * @method static Builder|OpQqToken query()
 * @method static Builder|OpQqToken whereAccessToken($value)
 * @method static Builder|OpQqToken whereAppid($value)
 * @method static Builder|OpQqToken whereCreatedAt($value)
 * @method static Builder|OpQqToken whereId($value)
 * @method static Builder|OpQqToken whereOpenId($value)
 * @method static Builder|OpQqToken whereUpdatedAt($value)
 * @mixin Eloquent
 */
class OpQqToken extends Model
{
    protected $table = 'op_qq_token';

    protected $fillable = [
        'appid',
        'open_id',
        'access_token',
    ];

}
