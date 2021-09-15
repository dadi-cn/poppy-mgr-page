<?php

namespace Misc\Commands;

use Cache;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Misc\Models\InvQuestion;
use Misc\Models\InvQuestionAnswer;
use Misc\Models\InvQuestionOptions;
use Misc\Models\InvQuestionUser;


class NjgjCommand extends Command
{

	/**
	 * The name and signature of the console command.
	 * @var string
	 */
	protected $signature = 'misc:inv';

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
		if (Cache::get('site-njgj')) {
			$items = Cache::get('site-njgj');
			$str   = '';
			foreach ($items as $item) {
				$str .= implode(',', $item) . PHP_EOL;
			}
			\Storage::disk('storage')->put('njgj.csv', $str);
			return;
		}
		$options = [];
		// nc
		// zz
		InvQuestionOptions::get()->groupBy('inv_question_id')->map(function (Collection $item, $id) use (&$options) {
			$options[$id] = $item->keyBy('inv_id');
		});

		$questions = InvQuestion::orderBy('inv_id')->get();

		$users = InvQuestionUser::get();
		$header = [
			'姓名',
			'手机号',
			'公司/单位',
		];

		foreach ($questions as $question) {
			$header[] = data_get($question, 'inv_question');
		}

		$item[]  = $header;
		foreach ($users as $user) {
			$one = [
				data_get($user, 'user_name'),
				data_get($user, 'user_phone'),
				data_get($user, 'user_dept'),
				data_get($user, 'user_email'),
				data_get($user, 'user_province'),
				data_get($user, 'user_city'),
			];

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
		Cache::forever('site-njgj', $item);
	}
}