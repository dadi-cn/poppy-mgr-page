<?php

namespace Demo\Forms;

use Poppy\Framework\Validation\Rule;
use Poppy\System\Models\PamAccount;

class FormMultiImage extends FormBaseWidget
{

    protected $title = 'MultiImage';


    public function data(): array
    {
        return [
            'image' => [
                'https://fakeimg.pl/640x480/282828/eae0d0/',
                'https://fakeimg.pl/480x640/282828/eae0d0/',
                'https://fakeimg.pl/480/282828/eae0d0/',
            ],
        ];
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $token = app('tymon.jwt.auth')->fromUser(PamAccount::first());
        $this->multiImage('image', '图片, 默认, 可上传')->rules([
            Rule::required(),
        ])->token($token);
        // 添加 code 代码
        $code = <<<CODE
\$token = app('tymon.jwt.auth')->fromUser(PamAccount::first());
\$this->image('image', '图片, 默认, 可上传')->rules([
    Rule::required(),
])->token($token);
CODE;
        $this->code('image-code', 'Code@图片, 默认, 可上传')->default($code);
        $this->divider();

    }
}