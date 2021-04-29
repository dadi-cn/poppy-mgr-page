<?php

namespace Poppy\SensitiveWord\Http\Request\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrPage\Http\Request\Backend\BackendController;
use Poppy\SensitiveWord\Action\Word;
use Poppy\SensitiveWord\Http\Forms\Backend\FormSensWordEstablish;
use Poppy\SensitiveWord\Http\Lists\Backend\ListSensitiveWord;
use Poppy\SensitiveWord\Models\SysSensitiveWord;
use Poppy\System\Classes\Grid;
use Response;
use Throwable;

/**
 * 敏感词控制器
 */
class WordController extends BackendController
{
    /**
     * 列表
     * @return array|JsonResponse|RedirectResponse|\Illuminate\Http\Response|Redirector|Resp|Response|string
     * @throws ApplicationException
     * @throws Throwable
     */
    public function index()
    {
        $grid = new Grid(new SysSensitiveWord());
        $grid->setLists(ListSensitiveWord::class);
        return $grid->render();
    }

    /**
     * 编辑/创建
     * @param null $id
     * @return array|JsonResponse|RedirectResponse|\Illuminate\Http\Response|Redirector|mixed|Resp|Response|string
     * @throws ApplicationException
     */
    public function establish($id = null)
    {
        $form = new FormSensWordEstablish();
        $form->setId($id);
        return $form->render();
    }

    /**
     * 删除
     * @param $id
     * @return array|JsonResponse|RedirectResponse|\Illuminate\Http\Response|Redirector|Resp|Response
     * @throws \Exception
     */
    public function delete($id)
    {
        $Word = $this->action();
        if (!$Word->delete($id)) {
            return Resp::error($Word->getError());
        }
        return Resp::success('删除成功', '_top_reload|1');
    }

    /**
     *
     * @return Word
     */
    private function action(): Word
    {
        return (new Word())->setPam($this->pam);
    }
}