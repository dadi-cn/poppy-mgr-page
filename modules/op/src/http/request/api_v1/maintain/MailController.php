<?php namespace Op\Http\Request\ApiV1\Maintain;

use Op\Action\MaintainAction;
use Poppy\Framework\Application\ApiController;
use Poppy\Framework\Classes\Resp;

/**
 * 邮箱
 */
class MailController extends ApiController
{


	/**
	 * @api                 {get} api_v1/maintain/mail/send 发送邮件
	 * @apiDescripiton      发送邮件
	 * @apiVersion          1.0.0
	 * @apiName             MailSend
	 * @apiGroup            Mail
	 * @apiParam {String}   mail    邮箱
	 * @apiParam {String}   title   标题
	 * @apiParam {String}   content 发送内容
	 */
	public function send()
	{
		$Maintain = new MaintainAction();
		if ($Maintain->sendMail(input('mail'), input('title'), input('content'))) {
			return Resp::success('发送邮件成功');
		}
		return Resp::error($Maintain->getError());
	}
}