<?php

namespace Demo\Http\Request\Api\Web;

use Illuminate\Support\Str;
use Poppy\MgrApp\Widgets\FormWidget;
use Poppy\System\Http\Request\ApiV1\Web\WebApiController;

class FormController extends WebApiController
{

    /**
     * @api                    {get} api/demo/form/:auto   [Demo]Form
     * @apiVersion             1.0.0
     * @apiName                FormText
     * @apiGroup               Form
     */
    public function auto($auto)
    {
        $type = ucfirst(Str::camel($auto));
        $class = "Demo\Http\Forms\Web\Form{$type}Establish";
        /** @var FormWidget $form */
        $form = new $class();
        $form->title($type, '基础表单的描述');
        return $form->resp();
    }
}
