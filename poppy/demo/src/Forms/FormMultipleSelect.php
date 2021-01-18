<?php namespace Poppy\Demo\Forms;

class FormMultipleSelect extends FormBaseWidget
{


    /**
     * 表单标题
     * @var string
     */
    public $title = 'MultipleSelect';


    /**
     * Build a form here.
     */
    public function form()
    {
        $this->divider('select 多选');

        $this->multipleSelect('datal', 'Fill')
            ->fill([
                1 => 'Name',
                2 => 'Name2',
                3 => 'Name3',
            ]);
    }
}