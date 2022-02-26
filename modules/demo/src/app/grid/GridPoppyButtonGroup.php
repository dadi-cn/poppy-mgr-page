<?php

namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Classes\Grid\Column\Render\ActionsRender;
use Poppy\MgrApp\Classes\Widgets\FilterWidget;
use Poppy\MgrApp\Http\Grid\GridBase;

/**
 * 按钮
 */
class GridPoppyButtonGroup extends GridBase
{
    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id');
        $this->column('type', 'TYPE')->display(function () {
            if (data_get($this, 'id') % 2 === 0) {
                return '分组';
            } else {
                return '散开';
            }
        });
        $this->column('action', '操作')->displayUsing(ActionsRender::class, [function (ActionsRender $actions) {
            $row = $actions->getRow();
            $actions->request('错误', route('demo:api.mgr_app.grid_request', ['error']));
            $actions->request('成功', route('demo:api.mgr_app.grid_request', ['success']));
            $actions->request('确认', route('demo:api.mgr_app.grid_request', ['success']))->confirm();
            $actions->request('Disabled', route('demo:api.mgr_app.grid_request', ['success']))->disabled();
            $actions->request('Plain', route('demo:api.mgr_app.grid_request', ['success']))->plain();
            $actions->request('Primary', route('demo:api.mgr_app.grid_request', ['success']))->primary();
            $actions->request('Plain', route('demo:api.mgr_app.grid_request', ['success']))->primary()->plain();
            $actions->page('页面', route('demo:api.mgr_app.grid_form', ['detail']), 'form');
        }]);
    }


    /**
     * @inheritDoc
     */
    public function filter(FilterWidget $filter)
    {
        $filter->like('username', 'username');
        // todo 这里应该是支持地区的
        // $filter->area('area', 'area');
        $filter->betweenDate('id', 'Between');
        $filter->lt('datetime', 'Datetime')->datetime();
        $filter->lt('date', 'Date')->date();
        $filter->lt('time', 'Time')->time();
    }
}
