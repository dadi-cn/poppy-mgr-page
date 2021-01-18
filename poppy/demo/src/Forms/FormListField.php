<?php namespace Poppy\Demo\Forms;

class FormListField extends FormBaseWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = 'ListField';


    /**
     * Build a form here.
     */
    public function form()
    {
        $this->divider('list-field  无法验证');
    }
}