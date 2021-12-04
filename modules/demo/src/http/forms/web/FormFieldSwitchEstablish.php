<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldSwitchEstablish extends FormWidget
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
            'id'       => 5,
            'is_enable' => '1',
            'is_enable_int' => 1,
            'is_text' => 0,
        ];
    }

    public function form()
    {
        $this->onOff('is_enable', '是否开启');
        $this->onOff('is_enable_int', '是否开启:Int');
        $this->onOff('is_text', '开启')->text('开', '关');
    }
}
