<?php namespace Poppy\Demo\Forms;

use Poppy\Framework\Validation\Rule;

class FormCode extends FormBaseWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = 'code';

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->code('code', 'Code')->help('代码输入框')->rules([
            Rule::required(),
        ]);
        // 添加 code 代码
        $code = <<<CODE
\$this->code('code', 'Code')->help('代码输入框');
CODE;
        $this->code('code-code', 'Code@Code')->default($code);
    }
}