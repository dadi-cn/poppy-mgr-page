<?php

namespace Poppy\MgrPage\Http\Request\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrPage\Http\Lists\Backend\ListPamBan;
use Poppy\System\Action\Ban;
use Poppy\System\Classes\Grid;
use Poppy\System\Http\Forms\Backend\FormBanEstablish;
use Poppy\System\Models\PamBan;
use Response;
use Throwable;

class BanController extends BackendController
{
    /**
     * 设备
     * @throws ApplicationException
     * @throws Throwable
     */
    public function index()
    {
        $grid = new Grid(new PamBan());
        $grid->setLists(ListPamBan::class);
        return $grid->render();
    }

    /**
     * 创建/编辑
     * @param null $id
     * @return array|JsonResponse|RedirectResponse|\Illuminate\Http\Response|Redirector|mixed|Resp|Response|string
     * @throws ApplicationException
     */
    public function establish($id = null)
    {
        $form = new FormBanEstablish();
        $form->setId($id);
        return $form->render();
    }

    /**
     * 删除
     * @param $id
     * @return array|JsonResponse|RedirectResponse|\Illuminate\Http\Response|Redirector|Resp|Response
     */
    public function delete($id)
    {
        $Ban = new Ban();
        if (!$Ban->delete($id)) {
            return Resp::error($Ban->getError());
        }
        return Resp::success('删除成功', '_reload|1');
    }
}