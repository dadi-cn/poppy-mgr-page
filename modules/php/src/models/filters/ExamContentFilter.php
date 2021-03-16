<?php

namespace Php\Models\Filters;

use EloquentFilter\ModelFilter;
use Poppy\Framework\Helper\TimeHelper;

/**
 * 考核问题filter
 */
class ExamContentFilter extends ModelFilter
{
	/**
	 * 根据ID查询
	 * @param int $id 问题id
	 * @return ExamContentFilter
	 */
	public function id($id)
	{
		return $this->where('id', $id);
	}

	/**
	 * 根据问题类型查询
	 * @param string $type 问题类型
	 * @return ExamContentFilter
	 */
	public function type($type)
	{
		return $this->where('type', $type);
	}

	/**
	 * 根据标题查询
	 * @param string $title 标题
	 * @return ExamContentFilter
	 */
	public function title($title)
	{
		return $this->whereLike('title', $title);
	}

	/**
	 * 根据用户输入的开始日期查询
	 * @param string $start_at 开始时间
	 * @return ExamContentFilter
	 */
	public function startAt($start_at)
	{
		return $this->where('created_at', '>', TimeHelper::dayStart($start_at));
	}

	/**
	 * 根据用户输入的结束日期开始查询
	 * @param string $end_at 结束时间
	 * @return ExamContentFilter
	 */
	public function endAt($end_at)
	{
		return $this->where('created_at', '<', TimeHelper::dayEnd($end_at));
	}
}