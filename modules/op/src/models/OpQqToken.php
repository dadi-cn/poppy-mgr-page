<?php

namespace Op\Models;

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
 * @property string      $device_info  设备信息|Demo
 * @property string      $oauth        临时授权信息
 * @method static Builder|OpQqToken newModelQuery()
 * @method static Builder|OpQqToken newQuery()
 * @method static Builder|OpQqToken query()
 */
class OpQqToken extends Model
{
    protected $table = 'op_qq_token';

    protected $casts = [
        'oauth'       => 'array',
        'device_info' => 'array',
    ];

    protected $fillable = [
        'appid',
        'open_id',
        'oauth',
        'device_info',
        'access_token',
    ];


    public function setOauthAttribute($option)
    {
        $this->attributes['oauth'] = json_encode($option, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function setDeviceInfoAttribute($option)
    {
        $this->attributes['device_info'] = json_encode($option, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
