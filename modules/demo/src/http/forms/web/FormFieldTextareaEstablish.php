<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\FakerException;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldTextareaEstablish extends FormWidget
{

    public function handle()
    {
        return Resp::success('');
    }

    /**
     * @throws FakerException
     */
    public function data(): array
    {
        return [
            'id'       => 5,
            'default'  => 'default str',
            'disabled' => py_faker()->text(20),
        ];
    }

    public function form()
    {
        $this->textarea('default', '文本区域');
        $this->textarea('rows', '行高度:3')->rows(3);
        $this->textarea('disabled', '禁用')->disabled();
        $this->textarea('placeholder', '占位符')->placeholder('占位符');
        $this->textarea('autosize', '自动大小')->autosize();
        $this->textarea('autosize-2-8', '自动大小:2-8')->autosize([
            'minRows' => 2, 'maxRows' => 8,
        ]);
        $this->textarea('autosize-1-4', '自动大小:1,4')->autosize(1, 4);
        $this->textarea('show-word-limit', '长度限制')->rules([
            Rule::max(20)
        ])->showWordLimit();
        $this->textarea('resize', '长度限制')->resize('none');
    }
}
