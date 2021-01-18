<?php namespace Poppy\Demo\Forms;

class FormMultipleFile extends FormBaseWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = 'MultipleFile';


    /**
     * Build a form here.
     */
    public function form()
    {
        $this->divider('multipleFile 无法验证');
    }
}