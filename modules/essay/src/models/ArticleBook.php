<?php namespace Essay\Models;

use Carbon\Carbon;
use Poppy\System\Models\PamAccount;

/**
 * @property int             $id
 * @property string          $title      书籍标题
 * @property int             $account_id User Id
 * @property int             $list_order 显示排序
 * @property bool            $is_favor   是否喜欢
 * @property int             $hits       点击量
 * @property Carbon          $created_at
 * @property Carbon          $updated_at
 * @property-read PamAccount $pam
 * @mixin \Eloquent
 */
class ArticleBook extends \Eloquent
{
	protected $table = 'article_book';

	protected $fillable = [
		'title',
		'account_id',
		'list_order',
		'is_favor',
		'hits',
	];

	public function pam()
	{
		return $this->belongsTo(PamAccount::class, 'account_id', 'id');
	}
}
