<?php

namespace Php\Action;

use Php\Models\ExamContent;
use Exception;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Validation\Rule;
use Validator;

/**
 * 考核问题处理
 */
class Exam
{
	use AppTrait;


	/** @var ExamContent */
	protected $exam;

	/** @var int */
	protected $examId;


	/**
	 * 编辑或者新增问题
	 * @param int   $id   问题id
	 * @param array $data 问题信息
	 * @return bool
	 */
	public function establish($data, $id = null)
	{
		$type   = sys_get($data, 'type');
		$initDb = [
			'title'   => sys_get($data, 'title'),
			'type'    => sys_get($data, 'type'),
			'options' => json_encode([
				'a' => sys_get($data, 'a'),
				'b' => sys_get($data, 'b'),
				'c' => sys_get($data, 'c'),
				'd' => sys_get($data, 'd'),
			]),
		];

		if ($type === ExamContent::TYPE_CHECKBOX) {
			$initDb['answer'] = implode(',', sys_get($data, 'answers', ''));
		}
		if ($type === ExamContent::TYPE_SELECT) {
			$initDb['answer'] = sys_get($data, 'answer', '');
		}

		$validator = Validator::make($initDb, [
			'title'   => [
				Rule::required(),
				Rule::string(),
			],
			'type'    => [
				Rule::required(),
				Rule::in('select', 'checkbox'),
			],
			'options' => [
				Rule::required(),
				Rule::string(),
			],
		], [], [
			'title'   => trans('user::db.exam.title'),
			'type'    => trans('user::db.exam.type'),
			'options' => '问题选项',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->messages());
		}

		if ($id && !$this->initExam($id)) {
			return $this->setError('lost');
		}

		if ($id) {
			$this->exam->update($initDb);
		}
		else {
			/** @var ExamContent $exam */
			$exam       = ExamContent::create($initDb);
			$this->exam = $exam;
		}

		return true;
	}

	/**
	 * delete question
	 * @param int $id 问题id
	 * @return bool
	 */
	public function delete($id)
	{
		$arr       = [
			'id' => $id,
		];
		$validator = Validator::make($arr, [
			'id' => [
				Rule::required(),
				Rule::integer(),
			],
		], [], [
			'id' => '必填',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->messages());
		}

		try {
			ExamContent::where('id', $id)->delete();

			return true;
		} catch (Exception $e) {
			return $this->setError($e->getMessage());
		}
	}

	/**
	 * 初始化问题数据
	 * @param int $id 问题id
	 * @return bool
	 */
	public function initExam($id)
	{
		try {
			$this->exam   = ExamContent::findOrFail($id);
			$this->examId = $this->exam->id;

			return true;
		} catch (Exception $e) {
			return $this->setError($e->getMessage());
		}
	}
}