<?php namespace Essay\Http\Request\Backend;

use Essay\Action\Essay;
use Essay\Models\EssayContent;
use Essay\Models\Filters\EssayContentFilter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Poppy\Framework\Classes\Resp;
use Poppy\System\Http\Request\Backend\BackendController;

/**
 * 文章管理控制器
 * @package App\Http\Controllers\Desktop
 */
class EssayController extends BackendController
{
	/**
	 * 文章列表
	 * @param null|int $id id
	 * @return Factory|View
	 */
	public function index($id = null)
	{
		$input = input();
		$items = EssayContent::filter($input, EssayContentFilter::class)->paginateFilter($this->pagesize);

		return view('essay::backend.content.index', [
			'items' => $items,
		]);
	}

	/**
	 * 文章Action
	 * @return Essay()
	 */
	private function action(): Essay
	{
		return (new Essay())->setPam($this->pam());
	}

	/**
	 * 创建/编辑文章
	 * @param null $id 广告ID
	 * @return Factory|JsonResponse|RedirectResponse|Response|Redirector|View
	 */
	public function establish($id = null)
	{
		$Essay = $this->action();
		if (is_post()) {
			$input = input();
			if (!$Essay->establish($input, $id)) {
				return Resp::web(Resp::ERROR, $Essay->getError());
			}

			return Resp::web(Resp::SUCCESS, '操作成功');
		}

		if ($id && !$item = EssayContent::find($id)) {
			return Resp::web(Resp::ERROR, '条目不存在');
		}

		return view('essay::backend.content.establish', [
			'id'   => $id ?? '',
			'item' => $item ?? [],
		]);
	}

	/**
	 * 删除文章
	 * @param int $id 文章ID
	 * @return JsonResponse|RedirectResponse|Response|Redirector
	 */
	public function delete($id)
	{
		$Essay = $this->action();
		if ($Essay->delete($id)) {
			return Resp::web(Resp::SUCCESS, '删除广告成功', 'pjax|1');
		}

		return Resp::web(Resp::ERROR, $Essay->getError());
	}
}