<?php

namespace Poppy\Area\Http\Request\Backend;

use Poppy\Area\Action\Area;
use Poppy\Area\Http\Forms\Backend\FormAreaEstablish;
use Poppy\Area\Http\Lists\Backend\ListArea;
use Poppy\Area\Models\SysArea;
use Poppy\Area\Models\Filters\AreaContentFilter;
use Poppy\Framework\Classes\Resp;
use Poppy\MgrPage\Http\Request\Backend\BackendController;
use Poppy\SensitiveWord\Http\Forms\Backend\FormSensWordEstablish;
use Poppy\System\Classes\Grid;
use Poppy\System\Models\SysConfig;

/**
 * 地区管理控制器
 */
class ContentController extends BackendController
{

    public function __construct()
    {
        parent::__construct();
        self::$permission = [
            'global' => 'backend:py-area.main.manage',
        ];
    }

    /**
     * 地区列表
     * @param null|int $id 地区id
     */
    public function index($id = null)
    {
        $grid = new Grid(new SysArea());
        $grid->setLists(ListArea::class);
        return $grid->render();

        $input       = input();
        $input['id'] = input('id') ?? $id;

        $top   = SysArea::where('level', '<=', 2)->select(['parent_id', 'title', 'id'])->get()->keyBy('id')->toArray();
        $items = SysArea::filter($input, AreaContentFilter::class)->paginateFilter($this->pagesize);

        return view('py-area::backend.content.index', [
            'items' => $items,
            'top'   => $top,
        ]);
    }

    /**
     * 地区添加/编辑
     * @param null|int $id 地区id
     */
    public function establish($id = null)
    {
        $city = input('city');
        $Area = $this->action();
        if (is_post()) {
            if ($Area->establish(input(), $id)) {
                return Resp::success('添加版本成功', '_reload|1');
            }

            return Resp::error($Area->getError());
        }

        $top  = [];
        $area = SysArea::where('parent_id', SysConfig::NO)->select(['title', 'id'])->get()->toArray();
        foreach ($area as $item) {
            $top[$item['id']] = $item['title'];
        }
        if ($city) {
            $second    = [];
            $area_city = SysArea::where('parent_id', $city)->select(['title', 'id'])->get()->toArray();
            foreach ($area_city as $item) {
                $second[$item['id']] = $item['title'];
            }

            return json_encode($second);
        }

        $id && $Area->initArea($id) && $Area->share();

        return view('py-area::backend.content.establish', [
            'top' => $top,
        ]);
    }

    /**
     * 删除地区
     * @param int $id 地区id
     * @throws \Exception
     */
    public function delete($id)
    {
        $Area = $this->action();
        if ($Area->delete($id)) {
            return Resp::success('删除成功', '_reload|1');
        }

        return Resp::error($Area->getError());
    }

    /**
     * 更新
     */
    public function fix()
    {
        return (new Area())->fixHandle();
    }

    /**
     * 版本Action
     * @return Area
     */
    private function action(): Area
    {
        return (new Area())->setPam($this->pam);
    }
}