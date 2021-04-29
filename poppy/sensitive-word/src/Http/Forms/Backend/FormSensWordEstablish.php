<?php

namespace Poppy\SensitiveWord\Http\Forms\Backend;

use Poppy\Framework\Classes\Resp;
use Poppy\SensitiveWord\Action\Word;
use Poppy\System\Classes\Widgets\FormWidget;

class FormSensWordEstablish extends FormWidget
{

    public $ajax = true;


    public function handle()
    {
        $Word = new Word();
        if (!$Word->establish(input())) {
            return Resp::error($Word->getError());
        }
        return Resp::success('操作成功', '_top_reload|1');
    }

    public function form()
    {
        $this->textarea('word', '敏感词')->help('一行一个');
    }
}
