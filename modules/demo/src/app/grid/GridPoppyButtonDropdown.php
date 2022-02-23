<?php

namespace Demo\App\Grid;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Grid\Column\Render\ActionsRender;
use Poppy\MgrApp\Http\Lists\ListBase;
use Poppy\MgrApp\Widgets\FilterWidget;

/**
 * 按钮
 */
class GridPoppyButtonDropdown extends ListBase
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
            if (data_get($row, 'id') % 2 === 0) {
                $actions->dropdown(3);
            }
            $actions->request('错误', route_url('demo:api.mgr_app.grid_request', ['error'], ['id' => data_get($row, 'id')]));
            $actions->request('成功', route_url('demo:api.mgr_app.grid_request', ['success'], ['id' => data_get($row, 'id')]));
            $actions->request('Disabled', route_url('demo:api.mgr_app.grid_request', ['success'], ['id' => data_get($row, 'id')]))->disabled();
            $actions->request('Plain', route_url('demo:api.mgr_app.grid_request', ['success'], ['id' => data_get($row, 'id')]))->plain();
            $actions->request('Primary', route_url('demo:api.mgr_app.grid_request', ['success'], ['id' => data_get($row, 'id')]))->primary();
            $actions->request('Plain', route_url('demo:api.mgr_app.grid_request', ['success'], ['id' => data_get($row, 'id')]))->primary()->plain();
            $actions->request('确认', route_url('demo:api.mgr_app.grid_request', ['success'], ['id' => data_get($row, 'id')]))->confirm();
            $actions->page('页面', route_url('demo:api.mgr_app.grid_form', ['detail']), 'form');
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
