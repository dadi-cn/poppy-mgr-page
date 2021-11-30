<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Exceptions\InvalidFieldParamException;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldNumberEstablish extends FormWidget
{

    public function handle()
    {
        return Resp::success('');
    }

    /**
     */
    public function data(): array
    {
        return [
            'id'      => 5,
            'default' => 28,
            'step'    => 4,
            'range'   => 16,
        ];
    }

    /**
     * @throws InvalidFieldParamException
     */
    public function form()
    {
        $this->number('default', '默认');
        $this->number('step', '步进:2')->step(2);
        $this->number('range', '4-28')->rules([
            Rule::max(28),
            Rule::min(4),
        ])->step(4);
        $this->number('precision', '精度:2')->rules([
            Rule::max(28),
            Rule::min(4),
        ])->step(0.08, true)->precision(2);
    }
}
