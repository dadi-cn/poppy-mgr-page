<?php namespace Poppy\AliyunPush\Jobs;

use Poppy\AliyunPush\Classes\AliPush;
use Poppy\AliyunPush\Classes\IosPushSender;
use Poppy\AliyunPush\Exceptions\PushException;


/**
 * 阿里推送Job @ Ios
 */
class IosJob extends BaseJob
{

    /**
     * Execute the job.
     *
     * @return void
     * @throws PushException
     */
    public function handle()
    {
        if (!count($this->broadcast)) {
            sys_error('poppy.aliyun-push.ios', __CLASS__, '信息不存在, 不进行发送');
        }
        $Ios = new IosPushSender($this->config);
        if ($this->type === AliPush::TYPE_NOTICE) {
            if (!$Ios->sendNotice($this->title, $this->body, $this->broadcast['type'], $this->broadcast['ids'] ?? [], $this->tags, $this->extra)) {
                sys_error('poppy.aliyun-push.ios-notice', __CLASS__, $Ios->getError());
            }
        }
        if ($this->type === AliPush::TYPE_MESSAGE) {
            if (!$Ios->sendMessage($this->title, $this->extra, $this->broadcast['type'], $this->broadcast['ids'] ?? [], $this->tags)) {
                sys_error('poppy.aliyun-push.ios-message', __CLASS__, $Ios->getError());
            }
        }
    }
}