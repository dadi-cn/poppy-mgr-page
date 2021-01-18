<?php namespace Url\Models;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;

/**
 * php artisan ide-helper:model 'Url\Models\UrlCollection'
 *
 * @property int    $id
 * @property string $title        导航名称
 * @property string $image        导航图标
 * @property string $description  导航图标
 * @property string $url          导航链接
 * @property string $cat_ids      所属分类id
 * @property int    $list_order   显示排序
 * @property int    $hits         点击次数
 * @property bool   $is_suggest   是否推荐
 * @property int    $account_id
 * @property string $icon
 * @property string $domain
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder|UrlCollection filter($input = [], $filter = null)
 * @method static Builder|UrlCollection paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|UrlCollection simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|UrlCollection whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|UrlCollection whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|UrlCollection whereLike($column, $value, $boolean = 'and')
 * @mixin \Eloquent
 */
class UrlCollection extends \Eloquent
{
	use Filterable;

	protected $table = 'url_collection';

	protected $fillable = [
		'title',
		'icon',
		'url',
		'description',
		'account_id',
		'is_user',
		'is_suggest',
		'list_order',
		'hits',
		'tag_ids',
	];
}
