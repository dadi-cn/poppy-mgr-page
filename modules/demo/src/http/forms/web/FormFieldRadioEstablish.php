<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldRadioEstablish extends FormWidget
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
            'id'    => 5,
            'radio' => 'a',
        ];
    }

    public function form()
    {
        $this->radio('radio', '单选')->options([
            'a' => 'A',
            'b' => 'B',
        ]);
        $this->radio('button', '默认:b')->options([
            'a' => 'A',
            'b' => 'B',
        ])->default('b')->button();
        $this->radio('complex', '复杂组合(禁用某一个条目)')->options([
            ['value' => 'a', 'disabled' => false, 'label' => 'Label A'],
            ['value' => 'b', 'disabled' => true, 'label' => 'Label B'],
        ], true)->default('a')->button();

    }
}
