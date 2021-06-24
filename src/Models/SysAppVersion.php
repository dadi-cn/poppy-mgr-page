<?php

declare(strict_types = 1);

namespace Poppy\Version\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Poppy\Core\Redis\RdsDb;
use Poppy\Version\Classes\PyVersionDef;

/**
 * User\Models\AppVersion
 *
 * @property int         $id
 * @property string      $title        版本号
 * @property string      $description  描述
 * @property string      $download_url 下载地址
 * @property int         $is_upgrade   是否强制升级当前版本
 * @property string      $platform     操作平台 android ios
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|SysAppVersion newModelQuery()
 * @method static Builder|SysAppVersion newQuery()
 * @method static Builder|SysAppVersion query()
 * @mixin Eloquent
 */
class SysAppVersion extends Eloquent
{
    /* 操作平台
   * ---------------------------------------- */
    public const PLATFORM_ANDROID = 'android';
    public const PLATFORM_IOS     = 'ios';

    protected $table = 'sys_app_version';

    protected $fillable = [
        'title',
        'description',
        'download_url',
        'is_upgrade',
        'platform',
    ];

    /**
     * @param null|string $key
     * @param bool        $check_key
     * @return array|string
     */
    public static function kvType($key = null, $check_key = false)
    {
        $desc = [
            self::PLATFORM_ANDROID => '安卓',
            self::PLATFORM_IOS     => 'IOS',
        ];

        return kv($desc, $key, $check_key);
    }

    /**
     * 返回版本
     * @param string $platform 操作平台
     * @return string|array
     */
    public static function latestVersion(string $platform = self::PLATFORM_ANDROID)
    {

        $version = RdsDb::instance()->hGet(PyVersionDef::ckTagMaxVersion(), $platform);
        if (!$version) {
            $versions = self::where('platform', $platform)->orderBy('created_at', 'desc')->get();
            if ($versions->count()) {
                $version = $versions->toArray();
                usort($version, function ($v1, $v2) {
                    return version_compare($v1['title'], $v2['title']);
                });
                $version = array_pop($version);
            }
            else {
                $version = [
                    'title'       => '1.0.0',
                    'description' => '默认版本',
                ];
            }
            RdsDb::instance()->hSet(PyVersionDef::ckTagMaxVersion(), $platform, $version);
        }
        return $version;
    }
}
