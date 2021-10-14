<?php

namespace Op\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;
use Op\Classes\OpDef;
use Poppy\Core\Redis\RdsDb;
use Poppy\Framework\Helper\StrHelper;
use Poppy\System\Mail\MaintainMail;
use Throwable;

/**
 * 使用命令行生成 api 文档
 */
class SendMailCommand extends Command
{

    protected $signature = 'op:send-mail
		{group : Group}
	';

    protected $description = 'Send Group Mail';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $group = $this->argument('group');
        $key   = OpDef::ckMailGroup($group);
        $lists = RdsDb::instance()->hGetAll($key);

        $content = '';
        if (count($lists)) {
            foreach ($lists as $_title => $list) {
                $content .= "<h3>{$_title}</h3>";
                $content .= "<div>{$list}</div>";
            }
        }
        $mail = sys_setting('op::maintain.' . $group . '-group');
        if (!$mail) {
            $this->error(sys_mark('op', __CLASS__, '没有设置组 `' . $group . '` 的接收邮箱', true));
            return;
        }
        if (!$content) {
            $this->error(sys_mark('op', __CLASS__, '组 `' . $group . '` 中无内容', true));
            return;
        }


        try {
            $mails = StrHelper::separate(',', $mail);
            Mail::to($mails)->send(new MaintainMail('慢日志@' . Carbon::now()->toDateTimeString(), $content));
            RdsDb::instance()->del($key);
            $this->info(sys_mark('op', __CLASS__, '组 `' . $group . '` 邮件已发送', true));
        } catch (Throwable $e) {
            $this->error(sys_mark('op', __CLASS__, $e, true));
        }
    }
}