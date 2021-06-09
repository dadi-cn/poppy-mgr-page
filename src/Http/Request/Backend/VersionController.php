<?php

namespace Poppy\Version\Http\Request\Backend;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrPage\Http\Request\Backend\BackendController;
use Poppy\System\Classes\Grid;
use Poppy\Version\Action\Version;
use Poppy\Version\Http\Forms\Backend\FormVersionEstablish;
use Poppy\Version\Http\Lists\Backend\ListAppVersion;
use Poppy\Version\Models\SysAppVersion;

/**
 * 版本管理控制器
 */
class VersionController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        self::$permission = [
            'global' => 'backend:py-version.main.manage',
        ];
    }

    public function index()
    {
        $grid = new Grid(new SysAppVersion());
        $grid->setLists(ListAppVersion::class);
        return $grid->render();
    }

    /**
     * 创建/编辑
     * @param null $id
     * @throws ApplicationException
     */
    public function establish($id = null)
    {
        $form = (new FormVersionEstablish())->setPam($this->pam);
        $form->setPlatform(input('platform'));
        $form->setId($id);
        return $form->render();
    }

    /**
     * 删除
     * @param $id
     * @throws \Exception
     */
    public function delete($id)
    {
        $Version = (new Version())->setPam($this->pam);
        if (!$Version->delete($id)) {
            return Resp::error('删除失败');
        }
        return Resp::success('删除成功', '_top_reload|1');
    }
}