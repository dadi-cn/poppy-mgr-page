<?php

namespace Demo\Http\Request\Web;

use Demo\Http\Lists\ListPoppyDemo;
use Demo\Models\PoppyDemo;
use Poppy\Framework\Classes\Resp;
use Poppy\System\Classes\Grid;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Classes\Widgets\TableWidget;
use Poppy\System\Http\Request\Web\WebController;

/**
 * 内容生成器
 */
class TableController extends WebController
{


    public function grid()
    {
        // 第一列显示id字段，并将这一列设置为可排序列
        $grid = new Grid(new PoppyDemo());
        return (new Content())->body($grid->render());
    }

    public function gridData()
    {
        return Resp::success('获取成功', [
            'list'       => [
                ['id' => 1],
            ],
            'pagination' => [
                'total' => 200,
                'page'  => 1,
                'size'  => 20,
                'pages' => 10,
            ],
        ]);
    }

    /**
     * 主页
     */
    public function index()
    {
        // table 1
        $headers = ['Id', 'Email', 'Name', 'Company'];
        $rows    = [
            [1, 'labore21@yahoo.com', 'Ms. Clotilde Gibson', 'Goodwin-Watsica'],
            [2, 'omnis.in@hotmail.com', 'Allie Kuhic', 'Murphy, Koepp and Morar'],
            [3, 'quia65@hotmail.com', 'Prof. Drew Heller', 'Kihn LLC'],
            [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
            [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.'],
        ];

        $table = new TableWidget($headers, $rows);

        return (new Content())->body($table->render());
    }

    public function demo()
    {
        // 第一列显示id字段，并将这一列设置为可排序列
        $grid = new Grid(new PoppyDemo());
        $grid->setTitle('Title');
        $grid->setLists(ListPoppyDemo::class);

        // $grid->disableCreateButton();

        // $grid->disablePagination();

        // $grid->disableFilter();

        // $grid->disableExport();

        // $grid->disableActions();

        // 未看到
        // $grid->disableColumnSelector();


        // $grid->disableRowSelector();

        // 设置单页的条目数
        $grid->perPages([15, 20, 30, 50, 100]);



        // 错误
        // $grid->column('radio')->radio([
        // 	1 => 'Sed ut perspiciatis unde omni',
        // 	2 => 'voluptatem accusantium doloremque',
        // ]);
        //
        // $grid->column('options')->checkbox([
        // 	1 => 'xx',
        // 	2 => 'xx',
        // ]);

        // $grid->model()->where('id', '>', 1);
        // $grid->model()->whereIn('id', [1, 2]);
        // $grid->model()->whereBetween('created_at', [TimeHelper::dayStart('2020-11-16'), TimeHelper::dayEnd('2020-11-17')]);
        // $grid->model()->whereColumn('created_at', '>', 'updated_at');
        // $grid->model()->orderBy('id', 'desc');
        // 无效
        // $grid->model()->take(1);
        // $grid->paginate(1);




        // 错误
        // $grid->column('username')->display(function ($userId) {
        // 	return PoppyDemo::find($userId)->username;
        // });

        // $grid->filter(function ($filter) {
        // 	$filter->between('created_at', '2020-11-16')->datetime();
        // });

        // $grid->fixColumns(0, -1);
        // $grid->desciption()->popover('left');



        // $grid->column('status')->icon([
        // 	1 => 'toggle-off',
        // 	2 => 'toggle-on',
        // ], $default = '');

        // $grid->column('status')->using([
        // 	1 => '审核通过',
        // 	2 => '草稿',
        // 	3 => '发布',
        // 	4 => '其它',
        // ], '未知')->dot([
        // 	1 => 'danger',
        // 	2 => 'info',
        // 	3 => 'primary',
        // 	4 => 'success',
        // ], 'warning');

        // $grid->column('link')->link();


        // $grid->column('status')->bool(['1' => true, '2' => false]);
        // $states = [
        // 	'on'  => ['value' => 1, 'text' => '打开', 'color' => 'primary'],
        // 	'off' => ['value' => 2, 'text' => '关闭', 'color' => 'default'],
        // ];
        // $grid->column('status')->switch($states);

        $grid->header(function ($query) {
            $data = $query->where('status', 3)->sum('progress');
            return "<div style='padding: 10px;'>数值 ： $data</div>";
        });

        $grid->footer(function ($query) {
            $data = $query->where('status', 2)->sum('progress');

            return "<div style='padding: 10px;'>数值 ： $data</div>";
        });

        $grid->expandFilter();

        // $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
        // 	$create->text('name', '名称');
        // 	$create->email('email', '邮箱');
        // });

        // $grid->quickSearch(function ($model, $query) {
        // 	$model->where('progress', 20)->where('username', 'like', "%{$query}%");
        // });

        // $grid->table();


        // $grid->columns('a', 'b', 'c');


        // $grid->quickSearch('username');

        // $grid->model()->whereYear('created_at', '2020');


        // table() 无法验证   字段为二维数组

        if (input('_query')) {
            return $grid->inquire($this->pagesize);
        }
        return (new Content())->body($grid->render());
    }
}