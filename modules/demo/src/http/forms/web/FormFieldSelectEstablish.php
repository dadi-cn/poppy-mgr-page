<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldSelectEstablish extends FormWidget
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
            'id'     => 5,
            'select' => 'a',
        ];
    }

    public function form()
    {
        $this->select('select', '单选')->options([
            'a' => 'A',
            'b' => 'B',
        ]);
        $this->select('placeholder', '单选')->options([
            'a' => 'A',
            'b' => 'B',
        ])->placeholder('占位内容');
        $this->select('disabled', '禁用')->options([
            'a' => 'A',
            'b' => 'B',
        ])->disabled();
        $this->select('complex', '单选/复杂模式')->options([
            ['value' => 'a', 'disabled' => false, 'label' => 'Label A'],
            ['value' => 'b', 'disabled' => true, 'label' => 'Label B'],
        ]);
        $this->select('group', '分组')->options([
            [
                'label'   => 'GroupA',
                'options' => [
                    ['value' => 'a1', 'disabled' => false, 'label' => 'A-1'],
                    ['value' => 'a2', 'disabled' => true, 'label' => 'A-2'],
                ],
            ],
            [
                'label'   => 'GroupB',
                'options' => [
                    ['value' => 'b1', 'disabled' => false, 'label' => 'B-1'],
                    ['value' => 'b2', 'disabled' => true, 'label' => 'B-2'],
                ],
            ],

        ]);


        $this->multiSelect('multi', '多选:禁用')->options([
            'a' => 'A',
            'b' => 'B',
        ]);
        $this->multiSelect('multi-complex', '多选:复杂模式')->options([
            ['value' => 'a', 'disabled' => false, 'label' => 'Label A'],
            ['value' => 'b', 'disabled' => true, 'label' => 'Label B'],
        ]);
        $this->multiSelect('multip-group', '多选:分组')->options([
            [
                'label'   => 'GroupA',
                'options' => [
                    ['value' => 'a1', 'disabled' => false, 'label' => 'A-1'],
                    ['value' => 'a2', 'disabled' => false, 'label' => 'A-2'],
                ],
            ],
            [
                'label'   => 'GroupB',
                'options' => [
                    ['value' => 'b1', 'disabled' => false, 'label' => 'B-1'],
                    ['value' => 'b2', 'disabled' => false, 'label' => 'B-2'],
                ],
            ],

        ])->rules([
            Rule::max(1)
        ]);
    }
}
