<?php

namespace Demo\Http\Forms\Web;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\FakerException;
use Poppy\Framework\Validation\Rule;
use Poppy\MgrApp\Widgets\FormWidget;

class FormFieldTextEstablish extends FormWidget
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
        $this->text('default', '文本');
        $this->text('disabled', '禁用')->disabled();
        $this->text('placeholder', '占位符')->placeholder('占位符');
        $this->text('clearable', 'Clearable')->clearable();
        $this->text('prefix-icon', '带有Icon(头部)')->prefixIcon('Search');
        $this->text('suffix-icon', '带有Icon(尾部)')->suffixIcon('Calendar');
        $this->text('max-length', '最大长度')->rules([
            Rule::max('20'),
        ])->showWordLimit();
        $this->url('url', 'Url')->rules([
            Rule::max('20'),
        ]);
        $this->password('password', 'Password');
        $this->mobile('mobile', 'Mobile');
        $this->ip('ip', 'Ip');
        $this->decimal('decimal', 'Decimal(3位小数)')->rules([
            Rule::between(0.000, 1.000),
        ])->digits(3);
        $this->email('email', '邮箱');
        $this->currency('currency', '人民币');
    }
}
