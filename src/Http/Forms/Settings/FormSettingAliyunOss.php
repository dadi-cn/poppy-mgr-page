<?php

namespace Poppy\AliyunOss\Http\Forms\Settings;

use Poppy\Framework\Validation\Rule;
use Poppy\System\Exceptions\FormException;
use Poppy\System\Http\Forms\Settings\FormSettingBase;

class FormSettingAliyunOss extends FormSettingBase
{

    public $title = '上传配置';

    protected $width = [
        'label' => 3,
        'field' => 9,
    ];

    protected $group = 'py-aliyun-oss::oss';

    /**
     * Build a form here.
     * @throws FormException
     */
    public function form()
    {
        $this->text('access_key', 'AccessKey')->rules([
            Rule::nullable(),
        ]);
        $this->text('access_secret', 'AccessSecret')->rules([
            Rule::nullable(),
        ]);
        $this->text('endpoint', 'EndPoint')->rules([
            Rule::nullable(),
        ]);
        $this->text('bucket', 'Bucket')->rules([
            Rule::nullable(),
        ]);
        $this->text('url_prefix', '域名前缀')->rules([
            Rule::nullable(),
        ]);
        $this->divider('用于资源授权');
        $this->text('role_arn', '角色描述符')->rules([
            Rule::nullable(),
        ])->help('角色资源描述符，在RAM的控制台的资源详情页上可以获取, 形如: acs:ram::157552**058:role/oss-upload');
        $this->text('temp_app_key', '授权key')->rules([
            Rule::nullable(),
        ]);
        $this->text('temp_app_secret', '授权secret')->rules([
            Rule::nullable(),
        ]);
    }
}
