<?php

namespace Essay\Http\Request\Web;

use Essay\Action\Article;
use Essay\Models\ArticleContent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Parsedown;
use Poppy\Framework\Classes\Resp;
use Session;
use Sunra\PhpSimple\HtmlDomParser;
use Poppy\System\Http\Request\Web\WebController;
use Validator;
use View;

class ArticleController extends WebController
{
	use AuthorizesRequests;

	/**
	 * 创建文章
	 * @param int $id
	 * @return JsonResponse|RedirectResponse|Redirector
	 */
	public function popup($id = 0)
	{
		if (is_post()) {
			$Article = (new Article())->setPam($this->pam());
			if ($Article->establishPopup(input(), $id)) {
				$prd = $Article->getArticle();

				return Resp::web(Resp::SUCCESS, '创建文档成功', 'top_location|' . route('essay:book.show', [$prd->book_id]));
			}

			return Resp::web(Resp::ERROR, $Article->getError());
		}
		$book_id = input('book_id');
		if ($id) {
			$item    = ArticleContent::find($id);
			$book_id = $item->book_id;
			View::share('item', $item);
		}
		if (!$book_id) {
			return Resp::web(Resp::ERROR, '不正确的数据');
		}
		$articles = ArticleContent::where('book_id', $book_id)->get();
		$items    = [];
		if ($articles->count()) {
			foreach ($articles as $prd) {
				$items[$prd->id] = [
					'id'        => $prd->id,
					'title'     => $prd->title,
					'parent_id' => $prd->parent_id,
				];
			}
		}

		return view('essay::web.article.popup', [
			'items'   => $items,
			'book_id' => $book_id,
		]);
	}

	public function establish($id)
	{
		if (is_post()) {
			$Prd = (new Article())->setPam($this->pam());
			if ($Prd->establish(input(), $id)) {
				return Resp::web(Resp::SUCCESS, '编辑成功!');
			}

			return Resp::web(Resp::ERROR, $Prd->getError());
		}
		/** @type ArticleContent $item */
		$item = ArticleContent::find($id);

		return view('essay::web.article.establish', [
			'item'    => $item,
			'pam'     => $this->pam(),
			'book_id' => $item->book_id,
		]);
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function show($id)
	{
		/** @type ArticleContent $article */
		$article  = ArticleContent::find($id);
		$Parser   = new Parsedown();
		$html     = $Parser->text($article->content);
		$html_dom = HtmlDomParser::str_get_html($html);
		$titles   = [];
		foreach ($html_dom->find('h1,h2,h3,h4,h5,h6,table') as $k => $title) {
			if (in_array($title->tag, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'])) {
				$tag      = $title->tag;
				$titles[] = [
					'id'    => 'header_' . $k,
					'text'  => $title->plaintext,
					'level' => str_replace('h', '', $tag),
				];
				$html     = str_replace(
					'<' . $tag . '>' . $title->plaintext . '</' . $tag . '>',
					'<' . $tag . ' id="' . 'header_' . $k . '">' . $title->plaintext . '</' . $tag . '>',
					$html
				);
			}
			if ($title->tag === 'table') {
				$html = str_replace('<table>', '<table class="table">', $html);
			}
		}

		$titles = collect($titles)->map(function ($item) {
			return <<<LI
	<li class="nav-item"><a class="nav-link side-lv{$item['level']}" href="#{$item['id']}">{$item['text']}</a></li>
LI;
		})->toArray();
		return view('essay::web.article.show', [
			'titles' => implode("\n", $titles),
			'item'   => $article,
			'html'   => $html,
		]);
	}


	/**
	 * 销毁文件
	 * @param $id
	 * @return array|JsonResponse|RedirectResponse|Response|Redirector
	 */
	public function destroy($id)
	{
		$Prd = (new Article())->setPam($this->pam());
		if ($Prd->destroy($id)) {
			return Resp::success('已删除', 'reload|1');
		}

		return Resp::error($Prd->getError());
	}

	public function name($parent_id, $name)
	{
		/** @var ArticleContent $parent */
		$parent = ArticleContent::findOrFail($parent_id);
		if ($parent->parent_id) {
			$parent = ArticleContent::findOrFail($parent_id);
		}
		$topParentId = ArticleContent::topParentId($parent_id);
		$topParent   = ArticleContent::find($topParentId);
		$item        = ArticleContent::where('top_parent_id', $topParentId)
			->where('title', trim($name))
			->first();
		if ($item) {
			return redirect(route('front_prd.show', [$item->id]));
		}

		$levelTitles = ArticleContent::parentTitles($parent_id, false, true);

		return view('web.prd.show', [
			'item'          => $item,
			'title'         => $name,
			'parent_id'     => $parent_id,
			'top_parent_id' => $topParentId,
			'top_parent'    => $topParent,
			'parent'        => $parent,
			'level_titles'  => $levelTitles,
		]);
	}

	public function status($id, $status)
	{
		if (!ArticleContent::kvStatus($status, true)) {
			return Resp::web('状态错误');
		}
		if (!is_array($id)) {
			$id = [$id];
		}

		ArticleContent::whereIn('id', $id)->update([
			'status' => $status,
		]);

		return Resp::web('OK~操作成功', 'reload|1');
	}

	public function address($prd_id)
	{
		if (!$prd_id) {
			return Resp::web('原型id不能为空');
		}
		/** @var ArticleContent $prd */
		$prd = ArticleContent::find($prd_id);
		if (empty($prd)) return Resp::web('原型不存在');

		$url      = route_url('front_prd.view', null, ['id' => $prd->id]);
		$code_url = route_url('support_util.qrcode_image', null, [
			't' => $url,
		]);

		return view('web.prd.address', [
			'item'     => $prd,
			'url'      => $url,
			'code_url' => $code_url,
		]);
	}

	/**
	 * 获取原型地址访问
	 * @param Request $request
	 * @return JsonResponse|RedirectResponse|Redirector
	 */
	public function views(Request $request)
	{
		$id = $request->input('id');
		if (!$id) return Resp::web('原型id不能为空');
		/** @var ArticleContent $prd */
		$prd = ArticleContent::find($id);
		if (empty($prd)) {
			return Resp::web('原型不存在');
		}

		$topParentId = ArticleContent::topParentId($id);

		// 检测原型是否加密
		// 已经加密并且没有密码
		if (
		($prd->role_status == ArticleContent::ROLE_STATUS_PWD && !Session::has('prd_view_' . $topParentId))
		) {
			return view('web.prd.view_pwd', [
				'item'     => $prd,
				'id_crypt' => $prd->id,
			]);
		}

		$html         = StrHelper::markdownToHtml($prd->content_origin);
		$prd->content = ArticleContent::mdInlineLink($html, $prd->id, false);
		$parent_id    = $prd->parent_id;
		$parent       = null;
		if ($prd->parent_id) {
			$parent    = ArticleContent::find($prd->parent_id);
			$parent_id = $parent->id;
		}

		$levelTitles = ArticleContent::parentTitles($id, false, true);

		return view('web.prd.view_content', [
			'item'         => $prd,
			'level_titles' => $levelTitles,
			'parent_id'    => $parent_id,
			'parent'       => $parent,
			'parent_url'   => route_url('front_prd.view', null, ['id' => $parent_id]),
		]);
	}

	/**
	 * 获取原型地址访问
	 * @param $id
	 * @return JsonResponse|RedirectResponse|Redirector
	 */
	public function detail($id)
	{
		if (!$id) return Resp::web('原型id不能为空');
		/** @var ArticleContent $prd */
		$prd = ArticleContent::with('front')->find($id);
		if (empty($prd)) {
			return Resp::web('原型不存在');
		}

		if ($prd->type == ArticleContent::TYPE_PRIVATE) {
			return Resp::web('私有文档不允许查看');
		}

		$content      = str_replace([
			'<body>', '<html>', '</body>', '</html>',
		], '', $prd->content);
		$html         = StrHelper::markdownToHtml($content);
		$prd->content = ArticleContent::mdInlineLink($html, $prd->id, false);
		$parent_id    = $prd->parent_id;
		$parent       = null;
		if ($prd->parent_id) {
			$parent    = ArticleContent::find($prd->parent_id);
			$parent_id = $parent->id;
		}

		$levelTitles = ArticleContent::parentTitles($id, false, true);

		$has_good     = false;
		$has_bad      = false;
		$has_transfer = false;

		return view('web.prd.detail', [
			'item'         => $prd,
			'level_titles' => $levelTitles,
			'parent_id'    => $parent_id,
			'parent'       => $parent,
			'has_good'     => $has_good,
			'has_transfer' => $has_transfer,
			'has_bad'      => $has_bad,
			'_title'       => $prd->title,
			'parent_url'   => route('front_prd.detail', $parent_id),
		]);
	}

	public function viewName($parent_id, $name)
	{
		/** @var ArticleContent $parent */
		$parent = ArticleContent::findOrFail($parent_id);
		if ($parent->parent_id) {
			$parent = ArticleContent::findOrFail($parent_id);
		}
		$topParentId = ArticleContent::topParentId($parent_id);
		/** @var ArticleContent $topParent */
		$topParent = ArticleContent::find($topParentId);
		$item      = ArticleContent::where('top_parent_id', $topParentId)
			->where('prd_title', trim($name))
			->first();
		if ($item) {
			return redirect(route_url('front_prd.view', null, ['id' => $item->id]));
		}

		$levelTitles = ArticleContent::parentTitles($parent_id, true);

		return view('web.prd.view_name', [
			'item'          => $item,
			'title'         => $name,
			'parent_id'     => $parent_id,
			'top_parent_id' => $topParentId,
			'top_parent'    => $topParent,
			'parent'        => $parent,
			'level_titles'  => $levelTitles,
			'parent_url'    => route_url('front_prd.view', null, ['id' => $this->encode($parent_id)]),
		]);
	}


	//权限设置
	public function access(Request $request, $prd_id)
	{
		if (is_post()) {
			if (!$prd_id) return Resp::web('原型id不能为空');
			$validator = Validator::make($request->all(), [
				'access' => 'required|integer',
			], [
				'access.required' => '权限类型必须选择',
			]);
			if ($validator->fails()) {
				return Resp::web($validator->errors());
			}

			$access   = $request->input('access');
			$password = $request->input('password');
			if ($access) {
				if (empty($password)) return Resp::web('密码不能为空');
			}

			$data = [
				'role_status' => $access,
				'password'    => $password,
			];
			ArticleContent::where('id', $prd_id)->update($data);

			return Resp::web('OK~权限设置成功', 'reload_opener|1;time|1000');
		}
		if (!$prd_id) {
			return Resp::web('原型id不能为空');
		}
		/** @var ArticleContent $prd */
		$prd = ArticleContent::find($prd_id);
		if (empty($prd)) return Resp::web('原型不存在');

		return view('web.prd.access', [
			'item' => $prd,
		]);
	}
}

