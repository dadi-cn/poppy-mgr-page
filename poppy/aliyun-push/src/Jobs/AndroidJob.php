<?php namespace Poppy\AliyunPush\Jobs;

use Poppy\AliyunPush\Classes\AliPush;
use Poppy\AliyunPush\Classes\AndroidPushSender;
use Poppy\AliyunPush\Exceptions\PushException;


/**
 * 阿里推送Job
 */
class AndroidJob extends BaseJob
{
    /**
     * Execute the job.
     *
     * @return void
     * @throws PushException
     */
    public function handle()
    {
        if (!$this->broadcast) {
            sys_error('poppy.aliyun-push.android', __CLASS__, '信息不存在, 不进行发送');
        }
        $Android = new AndroidPushSender($this->config);
        if ($this->type === AliPush::TYPE_NOTICE) {
            if (!$Android->sendNotice($this->title, $this->body, $this->broadcast['type'], $this->broadcast['ids'] ?? [], $this->tags, $this->extra)) {
                sys_error('poppy.aliyun-push.android-notice', __CLASS__, $Android->getError());
            }
        }
        if ($this->type === AliPush::TYPE_MESSAGE) {
            if (!$Android->sendMessage($this->title, $this->extra, $this->broadcast['type'], $this->broadcast['ids'] ?? [], $this->tags)) {
                sys_error('poppy.aliyun-push.android-message', __CLASS__, $Android->getError());
            }
        }
    }
}