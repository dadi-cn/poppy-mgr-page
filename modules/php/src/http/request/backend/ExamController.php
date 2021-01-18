<?php namespace Php\Http\Request\Backend;

use Php\Action\Exam;
use Php\Models\ExamContent;
use Php\Models\Filters\ExamContentFilter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Poppy\Framework\Classes\Resp;
use Poppy\System\Http\Request\Backend\BackendController;
use View;

/**
 * 账户管理
 */
class ExamController extends BackendController
{
	/**
	 * 问题列表
	 * @return Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$fields = [
			'title' => '标题',
			'id'    => '问题ID',
		];

		$input                 = input();
		$input[input('field')] = input('kw');

		$Db    = ExamContent::filter($input, ExamContentFilter::class);
		$items = $Db->paginate($this->pagesize);
		$items->appends($input);

		return view('exam::backend.exam.index', [
			'items'  => $items,
			'fields' => $fields,
		]);
	}

	/**
	 * c2e
	 * @param null|int $id 问题id
	 * @return Factory|JsonResponse|RedirectResponse|Response|Redirector|\Illuminate\View\View
	 */
	public function establish($id = null)
	{
		if (is_post()) {
			$Exam = $this->action();
			if (!$Exam->establish(input(), $id)) {
				return Resp::web(Resp::ERROR, $Exam->getError());
			}

			return Resp::web(Resp::SUCCESS, '修改成功', 'pjax|1');
		}
		if ($id) {
			/** @var ExamContent $item */
			$item      = ExamContent::findOrFail($id);
			$options   = json_decode($item->options, true);
			$item['a'] = $options['a'];
			$item['b'] = $options['b'];
			$item['c'] = $options['c'];
			$item['d'] = $options['d'];
			if ($item->type === ExamContent::TYPE_CHECKBOX) {
				$item['answers'] = explode(',', $item->answer);
			}
			else {
				$item['answer'] = $item->answer;
			}
			View::share([
				'item' => $item,
				'id'   => $id,
			]);
		}

		return view('exam::backend.exam.establish');
	}

	/**
	 * @param int $id 问题id
	 * @return JsonResponse|RedirectResponse|Response|Redirector
	 */
	public function delete($id)
	{
		$Version = $this->action();
		if ($Version->delete($id)) {
			return Resp::web(Resp::SUCCESS, '删除成功', 'pjax|1');
		}

		return Resp::web(Resp::ERROR, $Version->getError());
	}

	/**
	 * 获取action
	 * @return Exam
	 */
	private function action()
	{
		return (new Exam())->setPam($this->pam());
	}
}