<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldCheckboxEstablish extends FormWidget
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
            'checkbox' => ['a'],
        ];
    }

    public function form()
    {
        $this->checkbox('checkbox', '多选')->options([
            'a' => 'A',
            'b' => 'B',
        ]);
        $this->checkbox('check-all', '多选(支持快捷选择)')->options([
            'a' => 'A',
            'b' => 'B',
        ])->checkAll();
        $this->checkbox('check-all-btn', '多选(支持快捷选择)')->options([
            'a' => 'A',
            'b' => 'B',
        ])->checkAll()->button();
        $this->checkbox('button', '默认:b')->options([
            'a' => 'A',
            'b' => 'B',
        ])->default('b')->button();
        $this->checkbox('complex', '复杂组合(禁用某一个条目)')->options([
            ['value' => 'a', 'disabled' => false, 'label' => 'Label A'],
            ['value' => 'b', 'disabled' => true, 'label' => 'Label B'],
        ], true)->default('a')->button();
        $this->checkbox('range', '选择项在 2-8 之间')->options(array_combine(range('a', 'n'), range('A', 'N')))
            ->rules([
                Rule::min(2), Rule::max(8),
            ])
            ->default('a');

    }
}
