<?php namespace Poppy\MgrPage\Http\Request\Backend;

use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Poppy\Framework\Application\Controller;
use Poppy\Framework\Classes\Traits\PoppyTrait;
use Poppy\System\Models\PamAccount;

/**
 * 后台初始化控制器
 */
abstract class BackendController extends Controller
{
    use PoppyTrait;

    /**
     * @var PamAccount
     */
    protected $pam;

    public function __construct()
    {
        parent::__construct();
        py_container()->setExecutionContext('backend');
        $this->middleware(function ($request, $next) {
            $this->pam = $request->user();
            if ($this->pam) {
                $this->pyView()->share([
                    '_pam' => $this->pam,
                ]);
            }
            return $next($request);
        });
    }

    /**
     * 当前用户
     * @return Authenticatable|PamAccount
     */
    public function pam()
    {
        return Auth::guard(PamAccount::GUARD_BACKEND)->user();
    }
}