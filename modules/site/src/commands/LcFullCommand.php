<?php namespace Site\Commands;

use Cache;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Site\Models\InvQuestionAnswer;
use Site\Models\InvQuestionOptions;
use Site\Models\InvQuestionUser;
use Site\Models\InvQuestionUserlog;


class LcFullCommand extends Command
{

	/**
	 * The name and signature of the console command.
	 * @var string
	 */
	protected $signature = 'site:inv-full';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Gen Excode';

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		if (Cache::get('site-njgj-full')) {
			$items = Cache::get('site-njgj-full');
			$str   = '';
			foreach ($items as $item) {
				$str .= implode(',', $item) . PHP_EOL;
			}
			\Storage::disk('storage')->put('full.csv', $str);
			return;
		}
		$options = [];
		// nc
		// zz
		InvQuestionOptions::get()->groupBy('inv_question_id')->map(function (Collection $item, $id) use (&$options) {
			$options[$id] = $item->keyBy('inv_id');
		});

		$users = InvQuestionUser::where('inv_allow', 'nc')->get();
		$item[]  = [
			'姓名',
			'手机号',
			'公司/单位',
			'职位',
			'邮箱',
			'是否同意接收浪潮集团发送的关于产品、解决方案、服务或其他相关信息（可随时取消订阅）',
			'邀请人',
			'省/市',
			'行业',
			'嘉宾角色',
			'项目角色',
			'主营业务（生态伙伴必填）',
			'嘉宾级别',
			'是否VIP',
			'CRM客户名称（全称）',
			'客户标识（CRM客户编号）',
			'是否指名客户',
			'是否新客户',
			'年度采购规模（sv、str）',
			'邀请部门',
			'业务归属',
			'浪潮邀请人姓名',
			'浪潮邀请人电话',
			'参会情况',
			'大会前一日晚是否安排住宿（本单位自行安排）',
			'大会当日晚是否安排住宿（本单位自行安排）',
		];
		foreach ($users as $user) {
			$one = [
				data_get($user, 'user_name'),
				data_get($user, 'user_phone'),
				data_get($user, 'user_dept'),
				data_get($user, 'user_position'),
				data_get($user, 'user_email'),
				// data_get($user, 'user_province'),
				// data_get($user, 'user_city'),
			];

			$iu = InvQuestionUserlog::where('手机号', data_get($user, 'user_phone'))->first();

			$one[] = $iu['是否同意接收浪潮集团发送的关于产品、解决方案、服务或其他相关信息（可随时取消订阅）'] ?? '';
			$one[] = $iu['邀请人'] ?? '';
			$one[] = $iu['省/市'] ?? '';
			$one[] = $iu['行业'] ?? '';
			$one[] = $iu['嘉宾角色'] ?? '';
			$one[] = $iu['项目角色'] ?? '';
			$one[] = $iu['主营业务（生态伙伴必填）'] ?? '';
			$one[] = $iu['嘉宾级别'] ?? '';
			$one[] = $iu['是否VIP'] ?? '';
			$one[] = $iu['CRM客户名称（全称）'] ?? '';
			$one[] = $iu['客户标识（CRM客户编号）'] ?? '';
			$one[] = $iu['是否指名客户'] ?? '';
			$one[] = $iu['是否新客户'] ?? '';
			$one[] = $iu['年度采购规模（sv、str）'] ?? '';
			$one[] = $iu['邀请部门'] ?? '';
			$one[] = $iu['业务归属'] ?? '';
			$one[] = $iu['浪潮邀请人姓名'] ?? '';
			$one[] = $iu['浪潮邀请人电话'] ?? '';
			$one[] = $iu['参会情况'] ?? '';
			$one[] = $iu['大会前一日晚是否安排住宿（本单位自行安排）'] ?? '';
			$one[] = $iu['大会当日晚是否安排住宿（本单位自行安排）'] ?? '';

			$userAnswers = InvQuestionAnswer::where('inv_user_id', data_get($user, 'inv_id'))->orderBy('inv_question_id')->get()->groupBy('inv_question_id');
			foreach ($userAnswers as $questionId => $answers) {
				$oneAnswers = $options[$questionId];
				$q          = '';
				foreach ($answers as $answer) {
					$option = $oneAnswers[$answer->inv_options_id];
					$q      .= $option['inv_prefix'] . $option['inv_options'] . ($option['inv_answer_text'] ? "[{$option['inv_answer_text']}]" : '') . '，';
				}
				$one[] = rtrim($q, '，');

			}
			$item[] = $one;
		}
		Cache::forever('site-njgj-full', $item);
	}
}