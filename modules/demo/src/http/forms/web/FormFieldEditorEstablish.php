<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\FakerException;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldEditorEstablish extends FormWidget
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
            'default-code'  => <<<CODE
\$this->editor('default', 'Editor');
CODE,
        ];
    }

    public function form()
    {
        $this->editor('default', 'Editor');
        $this->code('default-code');
    }
}
