<?php

namespace Essay\Models\Policies;

use Essay\Models\ArticleContent;
use Poppy\System\Models\PamAccount;

class ArticleContentPolicy
{
	/**
	 * 创建
	 * @param PamAccount $pam
	 * @return bool
	 */
	public function create($pam)
	{
		return true;
	}


	/**
	 * 删除
	 * @param PamAccount     $pam
	 * @param ArticleContent $article
	 * @return bool
	 */
	public function destroy($pam, $article): bool
	{
		return $this->self($pam, $article);
	}

	/**
	 * 编辑
	 * @param PamAccount     $pam
	 * @param ArticleContent $article
	 * @return bool
	 */
	public function edit($pam, $article): bool
	{
		return $this->self($pam, $article);
	}

	/**
	 * 是否自己
	 * @param PamAccount     $pam
	 * @param ArticleContent $prd
	 * @return bool
	 */
	private function self($pam, $prd): bool
	{
		return !($prd->account_id !== $pam->id);
	}
}
