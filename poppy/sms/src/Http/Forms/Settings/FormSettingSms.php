<?php

namespace Poppy\Sms\Http\Forms\Settings;

use Poppy\Framework\Validation\Rule;
use Poppy\System\Http\Forms\Settings\FormSettingBase;

class FormSettingSms extends FormSettingBase
{
    protected $group = 'py-sms::sms';

    protected $withContent = true;

    public function form()
    {
        $this->radio('send_type', '发送方式')->options([
            'aliyun'    => '阿里云',
            'local'     => '本地',
            'chuanglan' => '创蓝',
        ])->rules([
            Rule::string(),
            Rule::required(),
        ])->default('local')->help('选择本地则文件存储在日志中, 需要自行查看');
        $this->text('expired_minute', '验证码有效期')->rules([
            Rule::nullable(),
        ])->default(5)->help('单位(分钟)');
        $this->text('sign', '默认签名')->rules([
            Rule::nullable(),
        ]);
        $this->text('aliyun_access_key', '阿里云 Key')->rules([
            Rule::nullable(),
        ]);
        $this->text('aliyun_access_secret', '阿里云 Secret')->rules([
            Rule::nullable(),
        ]);
        $this->text('chuanglan_access_key', '创蓝 Key')->rules([
            Rule::nullable(),
        ]);
        $this->text('chuanglan_access_secret', '创蓝 Secret')->rules([
            Rule::nullable(),
        ]);
    }
}
