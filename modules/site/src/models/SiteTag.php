<?php namespace Site\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Poppy\Framework\Helper\StrHelper;

/**
 * php artisan ide-helper:model 'App\Models\SiteTag'
 *
 * @mixin \Eloquent
 * @property int    $id
 * @property string $title
 * @property string $icon
 * @property string $num
 * @property string $account_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SiteTag extends \Eloquent
{
	protected $table = 'site_tag';

	protected $fillable = [
		'title',
		'spell',
		'first_letter',
		'list_order',
		'ref_num',
	];

	public static function decode($tags, $implode = '')
	{
		$tags   = trim($tags, '_,_');
		$return = $tags ? explode('_,_', $tags) : [];
		if ($implode) {
			return implode($implode, $return);
		}

		return $return;
	}

	public static function encode($tag_ids)
	{
		return $tag_ids ? '_,_' . implode('_,_', $tag_ids) . '_,_' : '';
	}

	/**
	 * 返回包含标签的数据
	 * @param $tags
	 * @return Collection|\Illuminate\Support\Collection|SiteTag[]
	 */
	public static function items($tags)
	{
		$tags  = array_filter($tags, 'trim');
		$items = collect();
		if (\count($tags)) {
			$items = self::whereIn('title', $tags)->get();
		}
		foreach ($tags as $tag) {
			if (!$items->where('title', $tag)->count()) {
				$item = self::firstOrCreate([
					'title' => $tag,
				], [
					'spell'        => implode('', StrHelper::chars2py($tag)),
					'first_letter' => implode('', StrHelper::chars2py($tag, true)),
				]);
				$items->push($item);
			}
		}

		return $items;
	}
}
