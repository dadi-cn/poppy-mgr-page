<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldDateEstablish extends FormWidget
{

    public function handle()
    {
        $message = print_r(input(), true);
        return Resp::success($message);
    }

    /**
     */
    public function data(): array
    {
        return [
            'id'      => 5,
            'default' => '',
        ];
    }

    public function form()
    {
        $this->date('default', 'Date:默认');
        $this->date('disabled', 'Date:禁用')->disabled();
        $this->date('placeholder', 'Date:占位符')->placeholder('Date占位符');
        $this->week('week', 'Week(当前返回数据有异常, 不要使用此插件)');
    }
}
