<?php

namespace Php\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Poppy\Framework\Classes\Resp;

/**
 * 中间件测试
 */
class TestMiddleware
{

	/**
	 * Handle an incoming request.
	 * @param Request $request 请求
	 * @param Closure $next    后续处理
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        print_r(sys_mark('php.test-middleware-before', __CLASS__).'<br/>');
		$response =  $next($request);
        print_r(sys_mark('php.test-middleware-after', __CLASS__).'<br/>');
		return $response;
	}
}