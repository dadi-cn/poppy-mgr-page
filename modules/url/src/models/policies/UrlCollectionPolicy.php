<?php namespace Url\Models\Policies;

use Poppy\System\Models\PamAccount;
use Url\Models\UrlCollection;

/**
 * url 管理
 */
class UrlCollectionPolicy
{
	/**
	 * 编辑
	 * @param PamAccount $pam 账号
	 * @return bool
	 */
	public function create(PamAccount $pam): bool
	{
		return true;
	}

	/**
	 * 编辑
	 * @param PamAccount    $pam 账号
	 * @param UrlCollection $url 存储地址
	 * @return bool
	 */
	public function edit(PamAccount $pam, UrlCollection $url): bool
	{
		return $pam->id === $url->account_id;
	}

	/**
	 * 删除
	 * @param PamAccount    $pam 账号
	 * @param UrlCollection $url 存储地址
	 * @return bool
	 */
	public function delete(PamAccount $pam, UrlCollection $url): bool
	{
		return $this->edit($pam, $url);
	}
}