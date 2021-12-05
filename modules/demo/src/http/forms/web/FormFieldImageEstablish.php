<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldImageEstablish extends FormWidget
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
            'id'          => 5,
            'default'     => 'default str',
            'image'       => 'https://wulicode.com/img/200x200/duoli',
            'multi-image' => [
                'https://wulicode.com/img/200x200/duoli',
                'https://wulicode.com/img/300x300/square',
                'https://wulicode.com/img/300x100/hengxiang',
                'https://wulicode.com/img/400x400/leecode',
            ],
        ];
    }

    public function form()
    {
        $this->image('image', '图片');
        $this->multiImage('multi-image', '多图')->rules([
            Rule::max(4),
        ]);
        $this->multiImage('multi-image-nolimit', '多图:不限制上传');
    }
}
