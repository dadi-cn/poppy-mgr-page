<?php

namespace Poppy\Area\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Poppy\Area\Classes\PyAreaDef;
use Poppy\Framework\Helper\TreeHelper;
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
 * @method static Builder|SysArea filter($input = [], $filter = null)
 * @method static Builder|SysArea pageFilter(PageInfo $pageInfo)
 * @method static Builder|SysArea paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|SysArea simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page')
 * @method static Builder|SysArea whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|SysArea whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|SysArea whereLike($column, $value, $boolean = 'and')
 * @url https://github.com/wecatch/china_regions
 */
class SysArea extends Eloquent
{
    use FilterTrait;

    const LEVEL_PROVINCE = 1;
    const LEVEL_CITY     = 2;
    const LEVEL_COUNTY   = 4;

    public $timestamps = false;

    protected $table = 'sys_area';

    protected $fillable = [
        'title',
        'code',
        'parent_id',
        'has_child',   // 是否有子集
        'level',       // 级别
        'top_parent_id',
        'children',
    ];

    public static function cityTree()
    {
        return sys_cache('py-area')->remember(PyAreaDef::ckArea('tree-level-2'), SysConfig::MIN_ONE_MONTH, function () {
            $items = SysArea::selectRaw("id,title,parent_id")->where('level', '<', 4)->get()->keyBy('id')->toArray();
            $Tree  = new TreeHelper();
            $Tree->init($items, 'id', 'parent_id', 'title');
            return $Tree->getTreeArray(0);
        });
    }


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
     * ID : Title
     * @param string $id ID : Title
     * @return mixed
     */
    public static function kvArea(string $id = ''): string
    {
        static $cache;
        if (!$cache) {
            $cache = sys_cache('py-area')->remember(PyAreaDef::ckArea('kv-area'), SysConfig::MIN_ONE_MONTH, function () {
                return self::select(['id', 'title'])->pluck('title', 'id')->toArray();
            });
        }
        return kv($cache, $id);
    }


    /**
     * 国家KV
     * @param string $code
     * @return string|array
     */
    public static function kvCountry($code = null)
    {
        static $cache;
        if (!$cache) {
            $cache = sys_cache('py-area')->remember(PyAreaDef::ckCountry('kv'), SysConfig::MIN_ONE_MONTH, function () {
                $area    = self::country();
                $collect = [];
                collect($area)->each(function ($country) use (&$collect) {
                    $collect[$country['iso']] = $country['zh'];
                });
                return $collect;
            });
        }
        return kv($cache, $code);
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