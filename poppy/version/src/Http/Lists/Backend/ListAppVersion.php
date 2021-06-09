<?php

namespace Poppy\Version\Http\Lists\Backend;

use Closure;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\System\Classes\Grid\Column;
use Poppy\System\Classes\Grid\Displayer\Actions;
use Poppy\System\Classes\Grid\Filter;
use Poppy\System\Classes\Grid\Tools\BaseButton;
use Poppy\System\Http\Lists\ListBase;
use Poppy\Version\Models\SysAppVersion;

class ListAppVersion extends ListBase
{

    public $title = '版本管理';

    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', "ID")->sortable()->width(80);
        $this->column('title', "版本号");
        $this->column('description', "版本描述");
        $this->column('download_url', "下载地址")->downloadable();
        $this->column('created_at', "创建时间");
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
                        $Action->edit($item),
                        $Action->delete($item),
                    ]);
                },
            ]);
    }

    /**
     * @inheritDoc
     * @return Closure
     */
    public function filter(): Closure
    {
        return function (Filter $filter) {
            $platforms = SysAppVersion::kvType();
            foreach ($platforms as $t => $v) {
                $filter->scope($t, $v)->where('platform', $t);
            }
        };
    }

    public function quickButtons(): array
    {
        return [
            $this->create(input(Filter\Scope::QUERY_NAME)),
        ];
    }

    /**
     * 创建
     * @param $platform
     * @return BaseButton
     */
    public function create($platform): BaseButton
    {
        return new BaseButton('<i class="fa fa-plus"></i> 新增', route_url('py-version:backend.version.establish', null, ['platform' => $platform]), [
            'title' => "新增",
            'class' => 'J_iframe layui-btn layui-btn-sm',
        ]);
    }

    /**
     * 编辑
     * @param $item
     * @return BaseButton
     */
    public function edit($item): BaseButton
    {
        return new BaseButton('<i class="fa fa-edit"></i>', route('py-version:backend.version.establish', [$item->id]), [
            'title' => "编辑[{$item->id}]",
            'class' => 'J_iframe',
        ]);
    }

    /**
     * 删除
     * @param $item
     * @return BaseButton
     */
    public function delete($item): BaseButton
    {
        return new BaseButton('<i class="fa fa-times"></i>', route('py-version:backend.version.delete', [$item->id]), [
            'title' => "删除",
            'class' => 'text-danger J_request',
        ]);
    }

}
