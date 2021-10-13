<?php

namespace Op\Action;

use Mail;
use Op\Classes\OpDef;
use Poppy\Core\Redis\RdsDb;
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

    /**
     * 邮件分组
     * @param string $group
     * @param string $title
     * @param string $content
     * @return bool
     */
    public function mailGroup(string $group, string $title, string $content): bool
    {
        $validator = Validator::make(compact('title', 'content', 'group'), [
            'title'   => Rule::required(),
            'content' => Rule::required(),
        ], [], [
            'title'   => '邮件标题',
            'content' => '邮件内容',
        ]);

        if ($validator->fails()) {
            return $this->setError($validator->errors());
        }

        RdsDb::instance()->hSet(OpDef::ckMailGroup($group), $title, $content);

        return true;
    }
}