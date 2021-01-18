<?php namespace Poppy\Demo\Forms;

use Poppy\Framework\Validation\Rule;

class FormEditor extends FormBaseWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = 'Editor';


    /**
     * Build a form here.
     */
    public function form()
    {
        $this->editor('editor', '编辑器Demo');
        // 添加 code 代码
        $code = <<<CODE
\$this->editor('editor', '编辑器Demo');
CODE;
        $this->code('editor-code', 'Code@编辑器Demo')->default($code);
        $this->divider();

        $this->editor('editor-required', '编辑器')->rules([
            Rule::required(),
        ])->help('内容必填');
        // 添加 code 代码
        $code = <<<CODE
\$this->editor('editor-required', '编辑器')->rules([
	Rule::required(),
]);
CODE;
        $this->code('editor-required-code', 'Code@编辑器')->default($code);
    }
}