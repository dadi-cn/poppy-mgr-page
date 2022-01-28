<?php

namespace Demo\Http\Request\Api\Web;

use Demo\App\Grid\GridPoppyUser;
use Demo\Models\PoppyDemo;
use Illuminate\Support\Str;
use Poppy\MgrApp\Widgets\GridWidget;
use Poppy\MgrApp\Widgets\FormWidget;
use Poppy\System\Http\Request\ApiV1\Web\WebApiController;

class MgrAppController extends WebApiController
{

    /**
     * @api                    {get} api/demo/form/:auto   [Demo]Form
     * @apiVersion             1.0.0
     * @apiName                Form
     * @apiGroup               MgrApp
     */
    public function form($auto)
    {
        $type  = ucfirst(Str::camel($auto));
        $class = "Demo\App\Forms\Form{$type}Establish";
        /** @var FormWidget $form */
        $form = new $class();
        $form->title($type, '基础表单的描述');
        return $form->resp();
    }

    /**
     * @api                    {get} api/demo/grid/:auto   [Demo]Grid
     * @apiVersion             1.0.0
     * @apiName                Grid
     * @apiGroup               MgrApp
     */
    public function grid($type)
    {
        // 第一列显示id字段，并将这一列设置为可排序列
        $grid = new GridWidget(new PoppyDemo());
        $grid->setTitle('Title');
        if ($type === 'normal') {
            $grid->setLists(GridPoppyUser::class);
        }
        return $grid->resp();
    }
}
