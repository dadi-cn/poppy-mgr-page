<?php

namespace Poppy\MgrPage\Http\Request\Develop;

use Carbon\Carbon;
use Curl\Curl;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Helper\CookieHelper;
use Poppy\System\Classes\Contracts\ApiSignContract;
use Session;
use Throwable;

/**
 * 开发平台控制台 cp = ControlPanel
 */
class CpController extends DevelopController
{
    /**
     * 开发者控制台
     */
    public function index()
    {
        return view('py-mgr-page::develop.cp.cp');
    }
}
