<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldFileEstablish extends FormWidget
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
            'file'    => 'https://test-oss.iliexiang.com/_res/conf.d/web-laravel.conf',
            'audio'   => 'https://test-oss.iliexiang.com/_res/audio/actor.mp3',
            'video'   => 'https://test-oss.iliexiang.com/_res/video/h-918k.mp4',
            'image'   => 'https://test-oss.iliexiang.com/_res/images/png-59k.png',
            'image-v' => 'https://wulicode.com/img/200x100/duoli',
        ];
    }

    public function form()
    {
        $this->file('file', 'File');
        $this->file('audio', 'Audio')->audio();
        $this->file('video', 'Video')->video();
        $this->file('Pdf', 'Pdf')->extensions(['pdf']);
        $this->image('image', 'Image');
    }
}
