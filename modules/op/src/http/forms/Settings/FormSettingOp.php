<?php

namespace Op\Http\Forms\Settings;

use Poppy\Framework\Validation\Rule;
use Poppy\System\Exceptions\FormException;
use Poppy\System\Http\Forms\Settings\FormSettingBase;

class FormSettingOp extends FormSettingBase
{
	public $title = '运维配置';

	protected $group = 'op::maintain';

	/**
	 * Build a form here.
	 * @throws FormException
	 */
	public function form()
	{
		$this->text('token', '对接 Token')->rules([
			Rule::required(),
		]);
		$this->text('aliyun_access_key', 'Aliyun Access Key')->rules([
			Rule::required(),
		]);
		$this->text('aliyun_access_secret', 'Aliyun Access Secret')->rules([
			Rule::required(),
		]);
		$this->text('aliyun_huowan_access_key', 'Aliyun HuoWan Key')->rules([
			Rule::required(),
		]);
		$this->text('aliyun_huowan_access_secret', 'Aliyun HuoWan Secret')->rules([
			Rule::required(),
		]);
	}
}
