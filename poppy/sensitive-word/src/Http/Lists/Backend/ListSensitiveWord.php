<?php

namespace Poppy\SensitiveWord\Http\Lists\Backend;

use Closure;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\System\Classes\Grid\Column;
use Poppy\System\Classes\Grid\Displayer\Actions;
use Poppy\System\Classes\Grid\Filter;
use Poppy\System\Classes\Grid\Tools\BaseButton;
use Poppy\System\Http\Lists\ListBase;

class ListSensitiveWord extends ListBase
{

    public $title = '敏感词';

    /**
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', "ID")->sortable()->width(80);
        $this->column('word', "敏感词");
    }


    public function filter(): Closure
    {
        return function (Filter $filter) {
            $filter->column(1 / 12, function (Filter $column) {
                $column->like('word', '敏感词');
            });
        };
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
        return new BaseButton('<i class="fa fa-plus"></i> 新增', route_url('py-sensitive-word:backend.word.establish', null), [
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
        return new BaseButton('<i class="fa fa-edit"></i>', route('py-sensitive-word:backend.word.establish', [$item->id]), [
            'title' => "编辑[{$item->word}]",
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
        return new BaseButton('<i class="fa fa-times"></i>', route('py-sensitive-word:backend.word.delete', [$item->id]), [
            'title' => "删除",
            'class' => 'text-danger J_request',
        ]);
    }
}
