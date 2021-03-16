<?php

namespace Op\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Poppy\Framework\Classes\Resp;

/**
 * 是否开启App 接口加密
 */
class MaintainTokenMiddleware
{

	/**
	 * Handle an incoming request.
	 * @param Request $request 请求
	 * @param Closure $next    后续处理
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// 未启用加密, 直接过滤掉
		$token = sys_setting('op::maintain.token');
		if (!sys_setting('op::maintain.token')) {
			return Resp::web(Resp::INNER_ERROR, '服务端尚未设置Token');
		}
		if (input('token') !== $token) {
			return Resp::web(Resp::PARAM_ERROR, 'Token 不正确');
		}
		return $next($request);
	}
}