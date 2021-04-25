<?php

namespace Poppy\Area\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Poppy\Area\Classes\PyAreaDef;
use Poppy\Framework\Http\Pagination\PageInfo;
use Poppy\System\Classes\Traits\FilterTrait;
use Poppy\System\Models\SysConfig;

/**
 * 地区表
 *
 * @property int    $id
 * @property string $code            编码
 * @property string $title           名称
 * @property string $parent_id       父级
 * @property string $top_parent_id   顶层ID
 * @property string $children        所有的子元素
 * @property int    $has_child       是否有子元素
 * @property int    $level           级别
 * @mixin Eloquent
 * @method static Builder|PyArea filter($input = [], $filter = null)
 * @method static Builder|PyArea pageFilter(PageInfo $pageInfo)
 * @method static Builder|PyArea paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|PyArea simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page')
 * @method static Builder|PyArea whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|PyArea whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|PyArea whereLike($column, $value, $boolean = 'and')
 * @url https://github.com/wecatch/china_regions
 */
class PyArea extends Eloquent
{
    use FilterTrait;

    const LEVEL_PROVINCE = 1;
    const LEVEL_CITY     = 2;
    const LEVEL_COUNTY   = 4;

    public $timestamps = false;

    protected $table = 'py_area';

    protected $fillable = [
        'title',
        'code',
        'parent_id',
        'has_child',   // 是否有子集
        'level',       // 级别
        'top_parent_id',
        'children',
    ];


    /**
     * 城市的KV
     * @param string $code 4位长度, 匹配身份证省份/城市
     * @return mixed
     */
    public static function kvCity(string $code = ''): string
    {
        static $cache;
        if (!$cache) {
            $cache = sys_cache('py-area')->remember(PyAreaDef::ckArea('kv-4'), SysConfig::MIN_ONE_MONTH, function () {
                return self::where('level', self::LEVEL_CITY)->selectRaw('left(code, 4) as code, title')->pluck('title', 'code')->toArray();
            });
        }
        return kv($cache, $code);
    }


    /**
     * 国家KV
     * @return array
     */
    public static function kvCountry(): array
    {
        return sys_cache('py-area')->remember(PyAreaDef::ckCountry('kv'), SysConfig::MIN_ONE_MONTH, function () {
            $area    = self::country();
            $collect = [];
            collect($area)->each(function ($country) use (&$collect) {
                $collect[$country['iso']] = $country['zh'];
            });
            return $collect;
        });
    }

    /**
     * 国别缓存
     * @return array|mixed
     */
    public static function country()
    {
        return sys_cache('py-area')->remember(PyAreaDef::ckCountry(), SysConfig::MIN_ONE_MONTH, function () {
            return include poppy_path('poppy.area', 'resources/def/country.php');
        });
    }
}