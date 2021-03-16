<?php

namespace Php\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Poppy\Framework\Http\Pagination\PageInfo;
use Poppy\System\Classes\Traits\FilterTrait;

/**
 *
 * @property int         $id
 * @property string      $title   问题内容
 * @property string      $type    问题类型 select:单选题 checkbox:多选题
 * @property string      $answer  答案
 * @property string      $options 选项
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ExamContent filter($input = [], $filter = null)
 * @method static Builder|ExamContent pageFilter(PageInfo $pageInfo)
 * @method static Builder|ExamContent paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|ExamContent simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page')
 * @method static Builder|ExamContent whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|ExamContent whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|ExamContent whereLike($column, $value, $boolean = 'and')
 * @mixin \Eloquent
 */
class ExamContent extends \Eloquent
{
	use FilterTrait;

	const TYPE_SELECT   = 'select';
	const TYPE_CHECKBOX = 'checkbox';

	protected $table = 'exam_content';

	protected $fillable = [
		'id',
		'title',
		'type',
		'answer',
		'options',
		'created_at',
		'updated_at',
	];

	/**
	 * @param null|string $key          Key
	 * @param bool        $check_exists 检测键值是否存在
	 * @return array|string
	 */
	public static function kvType($key = null, $check_exists = false)
	{
		$desc = [
			self::TYPE_SELECT   => '单选',
			self::TYPE_CHECKBOX => '多选',
		];

		return kv($desc, $key, $check_exists);
	}
}
