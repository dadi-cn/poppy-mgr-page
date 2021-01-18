<?php namespace Poppy\Area\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Poppy\Framework\Http\Pagination\PageInfo;
use Poppy\System\Classes\Traits\FilterTrait;

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
 * @method static Builder|AreaContent filter($input = [], $filter = null)
 * @method static Builder|AreaContent pageFilter(PageInfo $pageInfo)
 * @method static Builder|AreaContent paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|AreaContent simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page')
 * @method static Builder|AreaContent whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|AreaContent whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|AreaContent whereLike($column, $value, $boolean = 'and')
 */
class AreaContent extends Eloquent
{
    use FilterTrait;

    protected $table = 'area_content';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'parent_id',
        'has_child',   // 是否有子集
        'level',       // 级别
        'top_parent_id',
        'children',
    ];
}