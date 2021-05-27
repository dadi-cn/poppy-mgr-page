<?php

namespace Demo\Http\Request\Api\Web;

use Poppy\Framework\Application\ApiController;
use Poppy\Framework\Classes\Resp;

class RespController extends ApiController
{

    /**
     * @api                    {get} api/demo/resp/success   [Demo]Resp-Success
     * @apiDescription         接口成功请求
     * @apiVersion             1.0.0
     * @apiName                RespSuccess
     * @apiGroup               Demo
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
     * @api                    {get} api/demo/resp/error   [Demo]Resp-Error
     * @apiDescription         接口失败请求
     * @apiVersion             1.0.0
     * @apiName                RespError
     * @apiGroup               Demo
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

    /**
     * @api                    {get} api/demo/resp/401   [Demo]Resp-401
     * @apiDescription         接口未授权请求
     * @apiVersion             1.0.0
     * @apiName                Resp401
     * @apiGroup               Demo
     */
    public function unAuth()
    {
        return response()->json([
            'message' => 'Token 错误',
            'status'  => 401,
        ], 401);
    }

    /**
     * @api                    {get} api/demo/resp/header   [Demo]Resp-Header
     * @apiVersion             1.0.0
     * @apiName                RespHeader
     * @apiGroup               Demo
     */
    public function header()
    {
        return Resp::success('访问成功', [
            'x-app-id'      => x_app('id'),
            'x-app-os'      => x_app('os'),
            'x-app-version' => x_app('version'),
        ]);
    }
}
