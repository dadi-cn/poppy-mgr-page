<?php namespace Poppy\Demo\Forms;

use Poppy\Framework\Validation\Rule;

class FormListBox extends FormBaseWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = 'ListBox';


    /**
     * Build a form here.
     */
    public function form()
    {
        $this->listbox('list_box', 'listBox')->rules([Rule::required()]);

        $this->listbox('height')->height(200);
    }
}