<?php

namespace Poppy\MgrPage\Http\Lists\Backend;

use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\System\Classes\Grid\Column;
use Poppy\System\Classes\Grid\Displayer\Actions;
use Poppy\System\Classes\Grid\Tools\BaseButton;
use Poppy\System\Http\Lists\ListBase;
use Poppy\System\Models\PamBan;

class ListPamBan extends ListBase
{

    public $title = '封禁管理';

    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', "ID")->sortable()->width(80);
        $this->column('type', "类型")->display(function ($type) {
            return PamBan::kvType($type);
        });
        $this->column('value', "限制值");
    }

    /**
     * @inheritDoc
     */
    public function actions()
    {
        $Action = $this;
        $this->addColumn(Column::NAME_ACTION, '操作')
            ->displayUsing(Actions::class, [
                function (Actions $actions) use ($Action) {
                    $item = $actions->row;
                    $actions->append([
                        $Action->delete($item),
                    ]);
                },
            ]);
    }


    public function quickButtons(): array
    {
        return [
            $this->create(),
        ];
    }


    /**
     * 创建
     * @return BaseButton
     */
    public function create(): BaseButton
    {
        return new BaseButton('<i class="fa fa-plus"></i> 新增', route_url('py-mgr-page:backend.ban.establish', null), [
            'title' => "新增",
            'class' => 'J_iframe layui-btn layui-btn-sm',
        ]);
    }

    /**
     * 删除
     * @param $item
     * @return BaseButton
     */
    public function delete($item): BaseButton
    {
        return new BaseButton('<i class="fa fa-times"></i>', route('py-mgr-page:backend.ban.delete', [$item->id]), [
            'title' => "删除",
            'class' => 'text-danger J_request',
        ]);
    }
}
