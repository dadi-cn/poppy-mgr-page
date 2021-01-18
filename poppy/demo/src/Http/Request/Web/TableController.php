<?php namespace Poppy\Demo\Http\Request\Web;

use Poppy\Demo\Models\PoppyDemo;
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
        $grid->column('id', 'ID')->sortable();
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

        echo $table->render();

        // table 2
        $headers = ['Keys', 'Values'];
        $rows    = [
            'name'   => 'Joe',
            'age'    => 25,
            'gender' => 'Male',
            'birth'  => '1989-12-05',
        ];

        $table = new TableWidget($headers, $rows);

        echo $table->render();
    }

    public function demo()
    {
        // 第一列显示id字段，并将这一列设置为可排序列
        $grid = new Grid(new PoppyDemo());
        $grid->column('id', 'ID')->sortable()->style('color:red;');
        $grid->column('is_open', 'Is_open');
        // $grid->column('desc')->using(['1' => 'ha', '2' => 'xi']);
        $grid->column('desc')->replace(['ha' => '-']);
        // $grid->column('desc')->display(function ($desc) {
        // 	return $desc ? '是' : '否';
        // });
        $grid->column('created_at')->width(300)->color('#9b44cd')->sortable();
        $grid->column('updated_at')->hide();

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

        $grid->column('haha')->display(function ($email) {
            return "mailto:$email";
        });

        $grid->column('email', '头像')->gravatar(45);

        $grid->column('file')->downloadable();

        // $grid->column('status')->filter([
        // 	0 => '未知',
        // 	1 => '已下单',
        // 	2 => '已付款',
        // 	3 => '已取消',
        // ]);

        $grid->column('title')->limit(10)->ucfirst()->substr(1, 10)->link();

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

        // 不存的字段列
        $grid->column('full_name')->display(function () {
            return $this->is_open . ' ' . $this->desc;
        });

        // 添加不存在的字段
        $grid->column('column_not_in_table')->display(function () {
            return 'blablabla....';
        });


        // 错误
        // $grid->column('username')->display(function ($userId) {
        // 	return PoppyDemo::find($userId)->username;
        // });

        // $grid->filter(function ($filter) {
        // 	$filter->between('created_at', '2020-11-16')->datetime();
        // });

        // $grid->fixColumns(0, -1);
        $grid->showPagination();
        // $grid->desciption()->popover('left');

        $grid->column('first_name')->display(function ($first_name, $column) {
            if ($this->first_name === 'L') {
                return $first_name;

            }

            return $column->editable();
        });

        // $grid->column('desc')->view('content');

        $grid->column('link')->image('', 40, 60);

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

        $grid->column('progress')->loading([20], [50 => '完成']);
        $grid->column('last_name')->using(['N' => 'this is N', 'G' => 'this is G', 'H' => 'this is H']);
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
        $grid->filter(function (Grid\Filter $filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
        });

        // $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
        // 	$create->text('name', '名称');
        // 	$create->email('email', '邮箱');
        // });

        // $grid->quickSearch(function ($model, $query) {
        // 	$model->where('progress', 20)->where('username', 'like', "%{$query}%");
        // });

        // $grid->table();

        $grid->filter(function (Grid\Filter $filter) {
            $filter->column(1 / 12, function (Grid\Filter $filter) {
                $filter->like('username', 'username');
            });
            $filter->column(1 / 12, function (Grid\Filter $filter) {
                $filter->equal('status')->integer();
                $filter->startsWith('title');
                $filter->lt('progress')->integer();
                $filter->gt('progress')->integer();
                $filter->day('day');
                $filter->date('date');
                $filter->year('year');
                $filter->month('month');
                $filter->group('group', 'Group', function () {
                    return [
                        'id'       => 'ID',
                        'username' => '用户名',
                    ];
                });
                $filter->notEqual('created_at')->day();
            });

            // 去掉默认的id过滤器
            // $filter->disableIdFilter();

            // 在这里添加字段过滤器

        });

        // $grid->columns('a', 'b', 'c');

        $grid->column('trashed', '数量')->totalRow();

        // $grid->quickSearch('username');

        $grid->model()->whereYear('created_at', '2020');

        $grid->enableHotKeys();

        $grid->column('a')->label('danger');

        $grid->column('c')->progress();

        // table() 无法验证   字段为二维数组

        if (input('_query')) {
            return $grid->inquire($this->pagesize);
        }
        return (new Content())->body($grid->render());
    }
}