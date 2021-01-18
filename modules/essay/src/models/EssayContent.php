<?php namespace Essay\Models;

use Illuminate\Database\Eloquent\Builder;
use Poppy\Framework\Http\Pagination\PageInfo;
use Poppy\System\Classes\Traits\FilterTrait;

/**
 * System\Models\EssayContent
 *
 * @property int    $id
 * @property string $title        标题
 * @property string $description  描述
 * @property string $author       作者
 * @property int    $account_id   发布者id
 * @property string $content      内容
 * @property \Carbon\Carbon|null $created_at 创建时间
 * @property \Carbon\Carbon|null $updated_at 修改时间
 * @mixin \Eloquent
 * @method static Builder|EssayContent filter($input = [], $filter = null)
 * @method static Builder|EssayContent pageFilter(PageInfo $pageInfo)
 * @method static Builder|EssayContent paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|EssayContent simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page')
 * @method static Builder|EssayContent whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|EssayContent whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|EssayContent whereLike($column, $value, $boolean = 'and')
 */
class EssayContent extends \Eloquent
{
	use FilterTrait;

	protected $table = 'essay_content';

	protected $fillable = [
		'title',
		'description',
		'author',
		'content',
	];
}