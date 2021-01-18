<?php namespace Url\Http\Request\Api\Web;

use Curl\Curl;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Poppy\Framework\Classes\Resp;
use Site\Models\SiteTag;
use Poppy\System\Classes\HtmlParser;
use Poppy\System\Http\Request\Web\WebController;
use Throwable;
use Url\Action\Url;
use Url\Models\Filters\UrlCollectionFilter;
use Url\Models\UrlCollection;
use Url\Models\UrlRelTag;
use View;

/**
 * 导航
 */
class CollectionController extends WebController
{
	/**
	 * 导航地址
	 * @return mixed
	 */
	public function index()
	{
		$tag = input('tag');
		$pam = $this->pam();
		$Db  = UrlCollection::filter(input(), UrlCollectionFilter::class)
			->where('account_id', $pam->id);
		// user tags
		$userTags = SiteTag::whereIn('id', UrlRelTag::where('account_id', $pam->id)->pluck('tag_id'))
			->get();
		View::share([
			'user_tags' => $userTags,
		]);
		if ($tag) {
			$titles = explode('|', $tag);
			// tag id
			$arrTags = SiteTag::whereIn('title', $titles)->pluck('title', 'id');
			foreach ($arrTags as $tagId => $tagTitle) {
				$urlIds = UrlRelTag::where('tag_id', $tagId)->pluck('url_id');
				$Db->whereIn('id', $urlIds);
			}

			// other tagId
			$relUrlId    = UrlRelTag::whereIn('tag_id', $arrTags->keys())->pluck('url_id');
			$otherTagIds = UrlRelTag::whereIn('url_id', $relUrlId)
				->select('tag_id')
				->distinct()->whereNotIn('tag_id', $arrTags->keys())->pluck('tag_id');
			$otherTags   = SiteTag::whereIn('id', $otherTagIds)->get();

			View::share([
				'tags' => $arrTags,

				'rel_tags'   => $otherTags,
				'fun_remove' => function ($tag) use ($titles) {
					$str = '';
					foreach ($titles as $title) {
						if ($title !== $tag) {
							$str .= $tag . '|';
						}
					}

					return rtrim($str, '|');
				},
				'fun_add'    => function ($tag) use ($titles) {
					$titles[] = $tag;

					return implode('|', $titles);
				},
			]);
		}
		$items = $Db->simplePaginate($this->pagesize);

		\View::share('_pam', $pam);
		return view('url::collection.index', [
			'items' => $items,
		]);
	}

	/**
	 * 设定为已读
	 * @param null $id
	 * @return RedirectResponse|Redirector
	 */
	public function establish($id = null)
	{
		$Url = (new Url())->setPam($this->pam());

		if (is_post()) {
			if ($Url->establish(input(), $id)) {
				return Resp::success('操作成功!');
			}

			return Resp::error($Url->getError());
		}

		if (!$id && !$Url->canCreate(input('url'))) {
			return Resp::error($Url->getError());
		}

		$id && $Url->init($id) && $Url->share();

		if (!$id) {
			View::share('url', input('url'));
		}

		return view('url::collection.establish');
	}

	/**
	 * 批量删除
	 * @param null $id
	 * @return RedirectResponse|Redirector
	 * @throws Exception
	 */
	public function delete($id = null)
	{
		if (!$id) {
			return Resp::web(Resp::ERROR, '请选中要删除的信息');
		}
		$Collection = (new Url())->setPam($this->pam());
		if ($Collection->delete($id)) {
			return Resp::success('删除成功', 'top_reload|1');
		}

		return Resp::error($Collection->getError());
	}

	/**
	 * 获取标题
	 * @return RedirectResponse|Redirector
	 */
	public function fetchTitle()
	{
		$url = input('url');
		if (!$url) {
			return Resp::web(Resp::ERROR, '请填写url地址!');
		}

		try {
			$curl = new Curl();
			$curl->setTimeout(2);
			if (!preg_match('/^http(s)?:\/\/.*?/', $url)) {
				$url = 'http://' . $url;
			}
			$content     = $curl->get($url);
			$html        = new HtmlParser($content);
			$title       = $html->find('title', 0)->getPlainText();
			$description = $html->find('meta[name=description]', 0)->getAttr('content');

			return Resp::success('获取到标题', [
				'title'       => $title,
				'description' => $description,
				'url'         => $url,
				'forget'      => true,
			]);
		} catch (Throwable $e) {
			return Resp::error('没有找到相关网页标题', [
				'title'  => $url,
				'url'    => $url,
				'forget' => true,
			]);
		}
	}
}

