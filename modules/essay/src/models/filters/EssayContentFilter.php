<?php

namespace Essay\Models\Filters;

use EloquentFilter\ModelFilter;

/**
 * 文章
 */
class EssayContentFilter extends ModelFilter
{
	/**
	 * 根据ID搜索
	 * @param int $id 广告ID
	 * @return EssayContentFilter
	 */
	public function id($id): self
	{
		return $this->where('id', $id);
	}

	/**
	 * 根据标题搜索
	 * @param string $title 广告位标题
	 * @return EssayContentFilter
	 */
	public function title($title): self
	{
		return $this->where('title', 'like', '%' . $title . '%');
	}
}