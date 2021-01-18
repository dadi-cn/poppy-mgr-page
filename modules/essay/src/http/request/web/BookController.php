<?php namespace Essay\Http\Request\Web;

use Essay\Action\Book;
use Essay\Models\ArticleBook;
use Essay\Models\ArticleContent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Helper\TreeHelper;
use Poppy\System\Http\Request\Web\WebController;
use View;

class BookController extends WebController
{
	use AuthorizesRequests;

	public function my()
	{
		$items = ArticleBook::where('account_id', $this->pam()->id)
			->orderBy('created_at', 'desc')
			->paginate($this->pagesize);

		return view('essay::web.book.my', [
			'items' => $items,
		]);
	}

	/**
	 * 创建订单
	 * @param int $id
	 * @return JsonResponse|RedirectResponse|Redirector
	 */
	public function establish($id = null)
	{
		$Book = (new Book())->setPam($this->pam());
		if (is_post()) {
			if ($Book->establish(input(), $id)) {
				return Resp::web(Resp::SUCCESS, '创建文库成功', 'top_reload|1');
			}

			return Resp::web(Resp::ERROR, $Book->getError());
		}
		if ($id) {
			if ($Book->init($id)) {
				View::share([
					'item' => $Book->getBook(),
				]);
			}
		}

		return view('essay::web.book.establish');
	}

	public function show($id)
	{
		$book  = ArticleBook::find($id);
		$items = ArticleContent::where('book_id', $id)->get();

		$array = [];
		// 构建生成树中所需的数据
		foreach ($items as $k => $r) {
			$item          = [];
			$item['title'] = "<a target='_blank' href=\"" . route('essay:article.show', [$r->id]) . "\">{$r->title}</a>";
			$item['id']    = $r->id;
			$item['sort']  = $r->list_order;
			$item['pid']   = $r->parent_id;
			$item['add']   = "<a class='J_iframe' href=\"" . route_url('essay:article.popup', null, ['parent_id' => $r->id, 'book_id' => $id]) . "\"><i class='fa fa-plus'></i></a>";
			$item['edit']  = '<a href="' . route('essay:article.establish', [$r->id]) . "\"><i class='fa fa-edit'></i></a>";
			$item['del']   = "<a class=\"J_request\" href='" . route('essay:article.destroy', [$r->id]) . "' data-confirm=\"确定删除该文档吗?\" ><i class='fa fa-times'></i></a>";
			$array[$r->id] = $item;
		}
		// gen html
		$str = <<<TABLE_LINE
<tr>
	<td>\$id</td>
	<td>\$spacer \$title </td>
	<td class=\"txt-center\">
		  \$add  \$edit  \$del
	</td>
</tr>
TABLE_LINE;

		$Tree = new TreeHelper();
		$Tree->init($array);
		$html_tree = $Tree->getTree(0, $str);

		return view('essay::web.book.show', [
			'html_tree' => $html_tree,
			'book'      => $book,
		]);
	}
}

