<?php


namespace Demo\App\Grid;

use Demo\Models\DemoWebapp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Grid\Column\Render\ActionsRender;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 快捷列表
 * @mixin DemoWebapp
 */
class GridDisplay extends GridBase
{
    public string $title = '列快捷展示';

    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', 'QuickId')->quickId();
        $this->column('status', 'Status')->usingKv(DemoWebapp::kvStatus());
        $this->column('title-large', 'QuickTitleLarge')->display(function () {
            return $this->title;
        })->quickTitle(true);
        $this->column('color', 'QuickTitleLarge')->display(function () {
            return "<div style='{$this->style}'>$this->title</div>";
        })->quickTitle(true);
        $this->column('post_at', 'QuickDatetime')->quickDatetime();
        $this->action(function (ActionsRender $actions) {
            $actions->request('错误', route('demo:api.mgr_app.grid_request', ['error']));
        });
    }
}
