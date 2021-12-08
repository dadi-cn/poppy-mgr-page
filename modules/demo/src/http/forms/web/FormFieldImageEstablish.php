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
            'image-v'     => 'https://wulicode.com/img/200x100/duoli',
            'multi-image' => [
                'https://wulicode.com/img/200x200/duoli',
                'https://wulicode.com/img/300x300/square',
                'https://wulicode.com/img/300x100/hengxiang',
                'https://wulicode.com/img/100x200/v',
                'https://wulicode.com/img/400x400/leecode',
            ],
            'multi-file'  => [
                'https://test-oss.iliexiang.com/_res/conf.d/web-laravel.conf',
                'https://test-oss.iliexiang.com/_res/audio/actor.mp3',
                'https://test-oss.iliexiang.com/_res/video/h-918k.mp4',
                'https://test-oss.iliexiang.com/_res/images/png-59k.png',
                'https://wulicode.com/img/200x100/duoli',
                'https://test-oss.iliexiang.com/_res/images/dynamic-quan.webp',
                'https://test-oss.iliexiang.com/_res/images/gif-268k.gif',
                'https://test-oss.iliexiang.com/_res/images/jpg-v-2m.jpg',
            ],
        ];
    }

    public function form()
    {
        $this->image('image', '图片');
        $this->image('image-v', '图片:竖向');
        $this->multiImage('multi-image-4', '多图:Rule 4')->rules([
            Rule::max(4),
        ]);
        $this->multiFile('multi-file', '多文件');
        $this->multiFile('multi-audio', 'Audios')->rules([
            Rule::max(4),
        ])->audio();
        $this->multiFile('multi-video', 'Videos')->rules([
            Rule::max(4),
        ])->video();
        $this->multiImage('multi-image', 'Images');
    }
}
