<?php

namespace Demo\Http\Lists;

use Closure;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\System\Classes\Grid\Column;
use Poppy\System\Classes\Grid\Displayer\Actions;
use Poppy\System\Classes\Grid\Filter;
use Poppy\System\Classes\Grid\Tools\BaseButton;
use Poppy\System\Http\Lists\ListBase;

class ListPoppyDemo extends ListBase
{

    /**
     * @inheritDoc
     * @throws ApplicationException
     */
    public function columns()
    {
        $this->column('id', 'ID')->sortable()->style('color:red;');
        $this->column('is_open', 'Is_open');
        // $this->column('desc')->using(['1' => 'ha', '2' => 'xi']);
        $this->column('desc')->replace(['ha' => '-']);
        // $this->column('desc')->display(function ($desc) {
        // 	return $desc ? '是' : '否';
        // });
        $this->column('created_at')->width(300)->color('#9b44cd')->sortable();
        $this->column('updated_at')->hide();
        $this->column('haha')->display(function ($email) {
            return "mailto:$email";
        });

        $this->column('email', '头像')->gravatar(45);

        $this->column('file')->downloadable();

        // $this->column('status')->filter([
        // 	0 => '未知',
        // 	1 => '已下单',
        // 	2 => '已付款',
        // 	3 => '已取消',
        // ]);

        $this->column('title')->limit(10)->ucfirst()->substr(1, 10)->link();

        // 不存的字段列
        $this->column('full_name')->display(function () {
            return $this->is_open . ' ' . $this->desc;
        });

        // 添加不存在的字段
        $this->column('column_not_in_table')->display(function () {
            return 'blablabla....';
        });

        $this->column('first_name')->display(function ($first_name, $column) {
            if ($this->first_name === 'L') {
                return $first_name;
            }
            return $column->editable();
        });

        // $grid->column('desc')->view('content');

        $this->column('link')->image('', 40, 60);

        $this->column('progress')->loading([20], [50 => '完成']);
        $this->column('last_name')->using(['N' => 'this is N', 'G' => 'this is G', 'H' => 'this is H']);

        $this->column('trashed', '数量')->totalRow();


        $this->column('a')->label('danger');

        $this->column('c')->progress();
    }


    /**
     * @inheritDoc
     * @return Closure
     */
    public function filter(): Closure
    {
        return function (Filter $filter) {
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->like('username', 'username');
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->equal('status')->integer();
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->startsWith('title');
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->lt('progress')->integer();
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->gt('progress')->integer();
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->day('day');
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->date('date');
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->year('year');
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->month('month');
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->group('group', 'Group', function (Filter\Group $group) {
                    // 等于
                    $group->equal('=');

                    // 不等于
                    $group->notEqual('!=');

                    // 大于
                    $group->gt('>');

                    // 小于
                    $group->lt('<');

                    // 大于等于
                    $group->nlt('>=');

                    // 小于等于
                    $group->ngt('<=');

                    // 匹配
                    $group->match('*');

                    // 复杂条件
                    // $group->where('啥', function($f){
                    //     $f;
                    // });

                    // like查询
                    $group->like('%');

                    // like查询
                    $group->contains('*');

                    // ilike查询
                    $group->ilike('like');

                    // 以输入的内容开头
                    $group->startWith('start');

                    // 以输入的内容结尾
                    $group->endWith('endwith');
                });
            });
            $filter->column(1 / 12, function (Filter $filter) {
                $filter->notEqual('created_at')->datetime();
            });
        };
    }

    /**
     * @inheritDoc
     */
    public function actions()
    {
        $Action = $this;
        $this->addColumn(Column::ACTION_COLUMN_NAME, '操作')
            ->displayUsing(Actions::class, [
                function (Actions $actions) use ($Action) {
                    $item = $actions->row;
                    $actions->append([
                        $Action->password($item),
                        $Action->edit($item),
                    ]);
                },
            ]);
    }


    public function quickButtons(): array
    {
        return [
            $this->create(input(Filter\Scope::QUERY_NAME)),
        ];
    }


    /**
     * 创建
     * @param $type
     * @return BaseButton
     */
    public function create($type): BaseButton
    {
        $url = route_url('py-mgr-page:backend.pam.establish', null, ['type' => $type]);
        return new BaseButton('新增', $url, [
            'class' => 'J_iframe layui-btn layui-btn-sm layui-btn-normal',
        ]);
    }

    /**
     * 修改密码
     * @param $item
     * @return BaseButton
     */
    public function password($item): BaseButton
    {
        $url = route('py-mgr-page:backend.pam.password', [$item->id]);
        return new BaseButton('修改密码', $url, [
            'class' => 'J_iframe J_tooltip',
        ]);
    }


    /**
     * 编辑
     * @param $item
     * @return BaseButton
     */
    public function edit($item): BaseButton
    {
        $url = route('py-mgr-page:backend.pam.establish', [$item->id]);
        return new BaseButton("编辑[{$item->username}]", $url, [
            'class' => 'J_iframe J_tooltip',
        ]);
    }

}
