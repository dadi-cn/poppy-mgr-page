<?php namespace Poppy\Demo\Forms;

class FormId extends FormBaseWidget
{

    /**
     * 表单标题
     * @var string
     */
    public $title = 'Id';


    public function data()
    {
        return [
            // 'id' => 5,
        ];
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->id('id', 'Id')->default(1)->help('ID值显示');
        // 添加 code 代码
        $code = <<<CODE
\$this->id('id', 'Id')->default(1)->help('ID值显示');
CODE;
        $this->code('id-code', 'Code@Id')->default($code);
    }
}
