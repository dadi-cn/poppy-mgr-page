<?php

namespace Op\Http\Forms\Settings;

use Poppy\Framework\Validation\Rule;
use Poppy\System\Http\Forms\Settings\FormSettingBase;

class FormSettingOp extends FormSettingBase
{
    protected $title = '运维配置';

    protected $group = 'op::maintain';

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('token', '对接 Token')->rules([
            Rule::required(),
        ]);
        $this->text('dadi-group', 'Dadi 群组邮件')->rules([
            Rule::required(),
        ]);
    }
}
