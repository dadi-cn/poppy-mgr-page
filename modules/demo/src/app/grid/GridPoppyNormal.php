<?php

namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Grid\Column\Render\ActionsRender;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Http\Grid\GridBase;

class GridPoppyNormal extends GridBase
{
    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        // 自定义样式
        $this->column('id');
        $this->column('title', '标题')->width(150)->ellipsis();
        $this->column('file', '链接')->link()->width(160)->ellipsis();
        $this->column('image')->image();
        $this->column('download')->display(function () {
            return data_get($this, 'image');
        })->download();
        $this->column('pam.id', 'UserName')->width(100);
        $this->column('action', '操作')->displayUsing(ActionsRender::class, [function (ActionsRender $actions) {
            $actions->request('错误', route('demo:api.mgr_app.grid_request', ['error']));
            $actions->request('成功', route('demo:api.mgr_app.grid_request', ['success']));
            $actions->request('确认', route('demo:api.mgr_app.grid_request', ['success']))->confirm();
            $actions->request('Disabled', route('demo:api.mgr_app.grid_request', ['success']))->disabled();
            $actions->page('页面', route('demo:api.mgr_app.grid_form', ['detail']), 'form');
        }]);
    }


    /**
     * @inheritDoc
     */
    public function filter(FilterWidget $filter)
    {
        $filter->action(6, true);
        $filter->like('title', '标题')->width(4);
        // todo 这里应该是支持地区的
        // $filter->area('area', 'area');
        $filter->betweenDate('bd', 'Between');
        $filter->lt('datetime', 'Datetime')->datetime();
        $filter->lt('date', 'Date')->date();
        $filter->lt('time', 'Time')->time();
    }
}
