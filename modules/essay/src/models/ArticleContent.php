<?php namespace Essay\Models;

use Carbon\Carbon;
use Poppy\System\Models\PamAccount;

/**
 * \Slt\Models\ArticleContent
 *
 * @property int             $id
 * @property int             $parent_id
 * @property int             $book_id  所属文档ID
 * @property string          $title
 * @property string          $description
 * @property string          $content_md
 * @property string          $content  内容
 * @property string          $author
 * @property string          $icon
 * @property int             $good_num 点赞
 * @property int             $bad_num  差评
 * @property string          $password 访问密码
 * @property int             $list_order
 * @property int             $hits
 * @property string          $status
 * @property int             $account_id
 * @property int             $is_star  是否星标
 * @property string          $tag_note tag 标记
 * @property Carbon|null     $created_at
 * @property Carbon|null     $updated_at
 * @property-read PamAccount $pam
 * @mixin \Eloquent
 */
class ArticleContent extends \Eloquent
{
	const STATUS_DELETE = 'delete';
	const STATUS_TRASH  = 'trash';
	const STATUS_POST   = 'post';
	const STATUS_DRAFT  = 'draft';

	const ROLE_STATUS_NONE = 0;
	const ROLE_STATUS_PWD  = 1;

	protected $table = 'article_content';

	protected $fillable = [
		'title',
		'cat_id',
		'parent_id',
		'book_id',
		'content',
		'content_md',
		'account_id',
		'symbol_link',
		'role_status',
		'password',
		'description',
		'tag',
		'is_star',
		'tag_note',
		'author',
		'icon',
		'hits',
		'good_num',
		'bad_num',
		'list_order',
		'is_star',
		'tag_note',
	];

	public function pam()
	{
		return $this->belongsTo(PamAccount::class, 'account_id', 'id');
	}

	/**
	 * 文档状态
	 * @param null $key
	 * @param bool $check_key
	 * @return array|string
	 */
	public static function kvStatus($key = null, $check_key = false)
	{
		$desc = [
			self::STATUS_DELETE => '删除',
			self::STATUS_TRASH  => '回收',
			self::STATUS_POST   => '发布',
			self::STATUS_DRAFT  => '草稿',
		];

		return kv($desc, $key, $check_key);
	}

	/**
	 * 顶级 parent id
	 * @param $id
	 * @return mixed
	 */
	public static function topParentId($id)
	{
		$parent_id = self::where('id', $id)->value('parent_id');
		if ($parent_id === 0) {
			return $id;
		}

		return self::topParentId($parent_id);
	}
}
