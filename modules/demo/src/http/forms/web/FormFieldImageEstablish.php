<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\FakerException;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldImageEstablish extends FormWidget
{

    public function handle()
    {
        $message = print_r(input(), true);
        return Resp::success($message);
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
        $this->image('image', '图片');
    }
}
