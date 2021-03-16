<?php

namespace Op\Action;

use AlibabaCloud\Client\AlibabaCloud;
use Mail;
use Poppy\Framework\Classes\Traits\AppTrait;
use Poppy\Framework\Helper\StrHelper;
use Poppy\Framework\Validation\Rule;
use Poppy\System\Mail\MaintainMail;
use Throwable;
use Validator;

/**
 * App 版本
 */
class MaintainAction
{
	use AppTrait;

	/**
	 * 进行 Aliyun 的 CDN 刷新
	 * @param string $url  请求刷新的地址
	 * @param string $type 请求的类型
	 * @return bool
	 */
	public function cdn($url, $type = 'Directory'): bool
	{
		$key       = sys_setting('op::maintain.aliyun_access_key');
		$secret    = sys_setting('op::maintain.aliyun_access_secret');
		$validator = Validator::make(compact('key', 'secret', 'url'), [
			'key'    => 'required',
			'secret' => 'required',
			'url'    => [
				Rule::required(),
				Rule::url(),
			],
		], [], [
			'key'    => 'Aliyun Access Key',
			'secret' => 'Aliyun Access Secret',
			'url'    => '刷新地址',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->errors());
		}

		try {
			// Set up a global client
			AlibabaCloud::accessKeyClient($key, $secret)
				->regionId('cn-hangzhou')
				->asDefaultClient();
			$result = AlibabaCloud::rpc()
				->product('Cdn')
				->version('2018-05-10')
				->action('refreshObjectCaches')
				->method('POST')
				->options([
					'query' => [
						'ObjectPath' => $url,
						'ObjectType' => $type,
					],
				])
				->request();
			$taskId = data_get($result, 'RefreshTaskId');
			return $this->setSuccess('请求成功, 任务ID:' . $taskId);
		} catch (Throwable $e) {
			return $this->setError($e->getMessage());
		}
	}


	/**
	 * 进行 Aliyun 的 DCDN 刷新(全站加速)
	 * @param string $url  请求刷新的地址
	 * @param string $type 请求的类型
	 * @return bool
	 */
	public function dcdn($url, $type = 'Directory'): bool
	{
		$key       = sys_setting('op::maintain.aliyun_huowan_access_key');
		$secret    = sys_setting('op::maintain.aliyun_huowan_access_secret');
		$validator = Validator::make(compact('key', 'secret', 'url'), [
			'key'    => 'required',
			'secret' => 'required',
			'url'    => [
				Rule::required(),
				Rule::url(),
			],
		], [], [
			'key'    => 'Aliyun Huowan Access Key',
			'secret' => 'Aliyun Huowan Access Secret',
			'url'    => '刷新地址',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->errors());
		}

		try {
			// Set up a global client
			AlibabaCloud::accessKeyClient($key, $secret)
				->regionId('cn-hangzhou')
				->asDefaultClient();
			$result = AlibabaCloud::rpc()
				->product('dcdn')
				->version('2018-01-15')
				->action('RefreshDcdnObjectCaches')
				->method('POST')
				->options([
					'query' => [
						'ObjectPath' => $url,
						'ObjectType' => $type,
					],
				])
				->request();
			$taskId = data_get($result, 'RefreshTaskId');
			return $this->setSuccess('请求成功, 任务ID:' . $taskId);
		} catch (Throwable $e) {
			return $this->setError($e);
		}
	}

	/**
	 * 发送邮件
	 * @param string $title   标题
	 * @param string $content 邮件主体内容
	 * @param string $mail    邮件接收者
	 * @return bool
	 */
	public function sendMail($mail, $title, $content): bool
	{
		$validator = Validator::make(compact('title', 'content', 'mail'), [
			'title'   => Rule::required(),
			'content' => Rule::required(),
			'mail'    => Rule::required(),
		], [], [
			'title'   => '邮件标题',
			'content' => '邮件内容',
			'mail'    => '接收人',
		]);
		if ($validator->fails()) {
			return $this->setError($validator->errors());
		}

		try {
			$mails = StrHelper::separate(',', $mail);
			Mail::to($mails)->send(new MaintainMail($title, $content));
			return true;
		} catch (Throwable $e) {
			return $this->setError($e->getMessage());
		}
	}
}