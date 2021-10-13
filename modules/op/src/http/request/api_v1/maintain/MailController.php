<?php

namespace Op\Http\Request\ApiV1\Maintain;

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
     * @apiParam {String}   group   分组[后台根据分组发送邮件, 邮件在配置中定义]
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

    /**
     * @api                 {get} api_v1/maintain/mail/group 邮件分组
     * @apiDescripiton      分组发送邮件, 后端定时发送并清除
     * @apiVersion          1.0.0
     * @apiName             MailSend
     * @apiGroup            Mail
     * @apiParam {String}   group   分组[后台根据分组发送邮件, 邮件在配置中定义]
     * @apiParam {String}   title   标题
     * @apiParam {String}   content 发送内容
     */
    public function group()
    {
        $Maintain = new MaintainAction();
        if ($Maintain->mailGroup(input('group'), input('title'), input('content'))) {
            return Resp::success('邮件已保存');
        }
        return Resp::error($Maintain->getError());
    }
}