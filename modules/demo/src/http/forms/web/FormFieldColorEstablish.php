<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\FakerException;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldColorEstablish extends FormWidget
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
            'default'  => '#cccccc',
            'alpha'    => 'rgba(1,3,8,0.3)',
            'disabled' => py_faker()->text(20),
        ];
    }

    public function form()
    {
        $this->color('default', '颜色');
        $this->color('alpha', '透明度')->showAlpha();
        $this->color('predefined', '预定义颜色')->predefine([
            '#000', '#333', '#999', 'rgba(1,3,8,0.3)',
        ]);
        $this->color('disabled', '禁用')->disabled();
    }
}
