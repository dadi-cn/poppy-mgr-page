<?php namespace Url\Models;

use Carbon\Carbon;
use Site\Models\SiteTag;

/**
 * php artisan ide-helper:model 'App\Models\SiteUrl'
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
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @mixin \Eloquent
 */
class UrlRelTag extends \Eloquent
{
	protected $table = 'url_rel_tag';

	public $timestamps = false;

	protected $fillable = [
		'url_id',
		'tag_id',
		'account_id',
	];

	public function siteTag()
	{
		return $this->hasOne(SiteTag::class, 'id', 'tag_id');
	}

	/**
	 * @param string $tag_ids 标签ID
	 * @return string
	 */
	public static function translate($tag_ids)
	{
		if (empty($tag_ids)) {
			return '';
		}

		$tagCache  = sys_cache('url')->get('url.models.url_rel_tag.translate');
		$arrTagIds = SiteTag::decode($tag_ids);
		$needWrite = false;
		$kvTags    = [];
		foreach ($arrTagIds as $tagId) {
			if (!isset($tagCache[$tagId])) {
				$tag              = SiteTag::find($tagId);
				$tagCache[$tagId] = $tag->title;
				$needWrite        = true;
			}
			if (isset($tagCache[$tagId])) {
				$kvTags[$tagId] = $tagCache[$tagId];
			}
		}
		if ($needWrite) {
			sys_cache('url')->forever('url.models.url_rel_tag.translate', $tagCache);
		}

		$data = '';
		foreach ($kvTags as $id => $title) {
			$data .= '<a href="' . route_url('url:web.collection.index', null, ['tag' => $title]) . '">#' . $title . '</a>';
		}

		return $data;
	}
}
