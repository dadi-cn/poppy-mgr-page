<?php

namespace Poppy\Sms\Http\Forms\Settings;

use Poppy\Framework\Validation\Rule;
use Poppy\System\Exceptions\FormException;
use Poppy\System\Http\Forms\Settings\FormSettingBase;

class FormSettingSms extends FormSettingBase
{
    public $title = '短信';

    public $inbox = true;

    protected $group = 'py-sms::sms';

    /**
     * Build a form here.
     * @throws FormException
     */
    public function form()
    {
        $this->radio('send_type', '短信发送方式')->options([
            'aliyun' => '阿里云',
            'local'  => '本地',
        ])->rules([
            Rule::string(),
            Rule::required(),
        ])->default('local')->help('选择本地则文件存储在日志中, 需要自行查看');
        $this->text('expired_minute', '验证码有效期(分钟)')->rules([
            Rule::nullable(),
        ])->default(5);
        $this->text('sign', '签名')->rules([
            Rule::nullable(),
        ]);
        $this->text('aliyun_access_key', 'AccessKey(阿里云)')->rules([
            Rule::nullable(),
        ]);
        $this->text('aliyun_access_secret', 'AccessSecret(阿里云)')->rules([
            Rule::nullable(),
        ]);
    }
}
