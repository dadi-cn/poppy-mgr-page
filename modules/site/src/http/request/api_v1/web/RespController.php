<?php

namespace Site\Http\Request\ApiV1\Web;

use Poppy\Framework\Application\ApiController;
use Poppy\Framework\Classes\Resp;

class RespController extends ApiController
{

	/**
	 * @api                    {get} api_v1/site/resp/success   Resp-Success
	 * @apiDescription         接口成功请求
	 * @apiVersion             1.0.0
	 * @apiName                RespSuccess
	 * @apiGroup               Resp
	 * @apiSuccessExample      return
	 * {
	 *     "status": 0,
	 *     "message": "[开发]返回成功的信息"
	 * }
	 */
	public function success()
	{
		return Resp::success('返回成功的信息');
	}

	/**
	 * @api                    {get} api_v1/site/resp/error   Resp-Error
	 * @apiDescription         接口失败请求
	 * @apiVersion             1.0.0
	 * @apiName                RespError
	 * @apiGroup               Resp
	 * @apiSuccessExample      return
	 * {
	 *     "status": 1,
	 *     "message": "[开发]返回错误提示"
	 * }
	 */
	public function error()
	{
		return Resp::error('返回错误提示');
	}
}
