<?php

namespace Poppy\Sms\Http\Request\Backend;

use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Poppy\Framework\Classes\Resp;
use Poppy\MgrPage\Http\Request\Backend\BackendController;
use Poppy\Sms\Action\Sms;
use Poppy\Sms\Http\Forms\Settings\FormSettingSms;
use Poppy\System\Classes\Layout\Content;
use Poppy\System\Models\PamAccount;

/**
 * 短信控制器
 */
class SmsController extends BackendController
{

    public function __construct()
    {
        parent::__construct();

        self::$permission = [
            'global' => 'backend:py-sms.global.manage',
        ];
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $scope = config('poppy.sms.send_type');
        if (input('_scope')) {
            $scope = input('_scope');
        }
        $templates = collect($this->action()->getTemplates());

        return view('py-sms::backend.sms.index', [
            'scope' => $scope,
            'items' => array_values($templates->where('scope', $scope)->toArray()),
        ]);
    }


    /**
     * 短信模板c2e
     * @param null|int $id
     * @return Factory|JsonResponse|RedirectResponse|Response|Redirector|View
     */
    public function establish($id = null)
    {
        $Sms = $this->action();
        if (is_post()) {
            if (!$Sms->establish(input(), $id)) {
                return Resp::error($Sms->getError());
            }

            return Resp::success('操作成功!~', '_reload_opener|1');
        }

        if ($id) {
            $Sms->init($id) && $Sms->share();
        }
        else {
            view()->share([
                'scope' => input('_scope'),
            ]);
        }
        return view('py-sms::backend.sms.establish');
    }

    /**
     * 删除短信模板
     * @param null|int $id id
     * @return JsonResponse|RedirectResponse|Response|Redirector
     */
    public function destroy($id = null)
    {
        $Sms = $this->action();
        if (!$Sms->destroy($id)) {
            return Resp::error($Sms->getError());
        }

        return Resp::success('操作成功', '_reload|1');
    }


    /**
     * 短信配置
     * @return Content
     */
    public function store(): Content
    {
        return (new Content())->body(new FormSettingSms());
    }

    /**
     * @return Sms
     */
    private function action(): Sms
    {
        return (new Sms())->setPam(Auth::guard(PamAccount::GUARD_BACKEND)->user());
    }
}