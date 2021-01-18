<?php namespace Poppy\Demo\Forms;

class FormDisplay extends FormBaseWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = '显示框';


    public function data()
    {
        return [
            'display' => '默认显示的内容',
        ];
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->display('display', 'Display')
            ->help('显示输出');
        // 添加 code 代码
        $code = <<<CODE
\$this->display('display', 'Display')->help('显示输出');
CODE;
        $this->code('display-code', 'Code@Display')->default($code);
    }
}