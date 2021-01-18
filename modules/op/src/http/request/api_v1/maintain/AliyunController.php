<?php namespace Op\Http\Request\ApiV1\Maintain;

use Op\Action\MaintainAction;
use Poppy\Framework\Application\ApiController;
use Poppy\Framework\Classes\Resp;

/**
 * Aliyun
 */
class AliyunController extends ApiController
{


	/**
	 * @api                 {get} api_v1/maintain/aliyun/cdn 刷新CDN
	 * @apiDescripiton      刷新CDN
	 * @apiVersion          1.0.0
	 * @apiName             AliyunCdn
	 * @apiGroup            Site
	 * @apiParam {String}   url 请求地址
	 * @apiParam {String}   type 刷新类型 [Directory|目录;File|文件]
	 */
	public function cdn()
	{
		$Aliyun = new MaintainAction();
		if ($Aliyun->cdn(input('url'))) {
			return Resp::success('刷新成功');
		}
		return Resp::error($Aliyun->getError());
	}

	/**
	 * @api                 {get} api_v1/maintain/aliyun/dcdn 刷新全局加速
	 * @apiDescripiton      刷新全局加速
	 * @apiVersion          1.0.0
	 * @apiName             AliyunDcdn
	 * @apiGroup            Site
	 * @apiParam {String}   url 请求地址
	 * @apiParam {String}   type 刷新类型 [Directory|目录;File|文件]
	 */
	public function dcdn()
	{
		$Aliyun = new MaintainAction();
		if ($Aliyun->dcdn(input('url'))) {
			return Resp::success('刷新成功');
		}
		return Resp::error($Aliyun->getError());
	}
}