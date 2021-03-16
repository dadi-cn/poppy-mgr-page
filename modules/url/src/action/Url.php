<?php

namespace Url\Action;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Poppy\Framework\Classes\Traits\AppTrait;
use Site\Models\SiteTag;
use Poppy\System\Classes\Traits\PamTrait;
use Url\Models\UrlCollection;
use Url\Models\UrlRelTag;

/**
 * 网址处理
 */
class Url
{
	use AppTrait, PamTrait, AuthorizesRequests;

	/**
	 * @var  UrlCollection
	 */
	protected $url;

	/**
	 * @var int
	 */
	private $id;

	/**
	 * @return UrlCollection
	 */
	public function getSiteUrl(): UrlCollection
	{
		return $this->url;
	}

	/**
	 * 处理分组
	 * @param array    $data
	 * @param null|int $id
	 * @return bool
	 */
	public function establish($data, $id = null): bool
	{
		if (!$this->checkPam()) {
			return false;
		}

		$initDb = [
			'title'       => (string) array_get($data, 'title', ''),
			'description' => (string) array_get($data, 'description', ''),
			'url'         => rtrim((string) array_get($data, 'url', ''), '/'),
			'icon'        => (string) array_get($data, 'icon'),
		];
		// data
		$validator = \Validator::make($initDb, [
			'title'       => 'required',
			'url'         => 'required|url',
			'description' => 'max:250',
		], [], [
			'title'       => '网站标题',
			'url'         => '网站地址',
			'description' => '描述',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->messages());
		}

		$tags    = sys_get($data, 'tag');
		$objTags = collect();

		if (\is_array($tags) && \count($tags)) {
			$objTags           = SiteTag::items($tags);
			$initDb['tag_ids'] = SiteTag::encode($objTags->pluck('id')->toArray());
		}

		try {
			return \DB::transaction(function () use ($id, $initDb, $objTags) {
				// init or create
				if ($id) {
					if (!$this->init($id)) {
						return false;
					}
					$this->url->update($initDb);
				}
				else {
					$this->url = UrlCollection::firstOrCreate([
						'url'        => $initDb['url'],
						'account_id' => $this->pam->id,
					], $initDb);
				}
				// update rel
				if ($objTags->count()) {
					UrlRelTag::where('url_id', $this->url->id)->delete();
					$relations = collect();
					$objTags->each(function ($item) use ($relations) {
						$relations->push([
							'url_id'     => $this->url->id,
							'tag_id'     => $item->id,
							'account_id' => $this->pam->id,
						]);
					});
					UrlRelTag::insert($relations->toArray());
				}

				return true;
			});
		} catch (\Throwable $e) {
			return $this->setError($e->getMessage());
		}
	}

	/**
	 * 保存的地址
	 * @param string $url 请求的地址
	 * @return bool
	 */
	public function canCreate($url): bool
	{
		if (!$this->checkPam()) {
			return false;
		}
		$url = rtrim((string) $url, '/');
		if (UrlCollection::where('url', $url)
			->where('account_id', $this->pam->id)->exists()) {
			return $this->setError('已经收藏过此链接');
		}

		return true;
	}

	/**
	 * 删除Url
	 * @param $id
	 * @return bool
	 */
	public function delete($id): bool
	{
		if (!$this->checkPam()) {
			return false;
		}
		if (!$this->init($id)) {
			return false;
		}

		if (!$this->pam->can('delete', $this->url)) {
			return $this->setError('您无权删除!');
		}

		try {
			return \DB::transaction(function () {
				UrlRelTag::where('url_id', $this->url->id)->delete();
				$this->url->delete();

				return true;
			});
		} catch (\Throwable $e) {
			return $this->setError($e->getMessage());
		}
	}

	public function init($id)
	{
		try {
			$this->url = UrlCollection::findOrFail($id);

			return true;
		} catch (\Exception $e) {
			return $this->setError('条目不存在, 不得操作');
		}
	}

	public function share()
	{
		\View::share([
			'item' => $this->url,
			'tags' => $this->tags()->toArray(),
		]);
	}

	/**
	 * 获取所有标签
	 * @return array|Collection
	 */
	public function tags()
	{
		$tagIds = UrlRelTag::where('url_id', $this->url->id)->pluck('tag_id');
		if (!$tagIds) {
			return [];
		}

		return SiteTag::whereIn('id', $tagIds)->pluck('title', 'title');
	}
}