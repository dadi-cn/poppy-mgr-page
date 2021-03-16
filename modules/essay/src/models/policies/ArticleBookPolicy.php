<?php

namespace Essay\Models\Policies;

use Essay\Models\ArticleBook;
use Poppy\System\Models\PamAccount;

class ArticleBookPolicy
{
	/**
	 * 是否可以编辑
	 * @param PamAccount  $pam
	 * @param ArticleBook $prd
	 * @return bool
	 */
	public function edit($pam, $prd)
	{
		if ($prd->account_id !== $pam->id) {
			return false;
		}

		return true;
	}
}
