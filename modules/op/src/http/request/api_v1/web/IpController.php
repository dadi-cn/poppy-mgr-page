<?php

namespace Op\Http\Request\ApiV1\Web;

use Poppy\Extension\IpStore\Classes\Contracts\IpContract;
use Poppy\Framework\Application\ApiController;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Helper\UtilHelper;

/**
 * Ip 查询工具
 */
class IpController extends ApiController
{


	/**
	 * @api                 {get} api_v1/maintain/ip/query IP查询
	 * @apiDescripiton      IP 查询
	 * @apiVersion          1.0.0
	 * @apiName             IpQuery
	 * @apiGroup            Ip
	 * @apiParam {String}   ip    IP
	 * @apiSuccessExample   data
	 * {
	 *     "area": "中国 山东 济南"
	 * }
	 */
	public function query()
	{
		$ip = input('ip');

		if (!$ip || !UtilHelper::isIp($ip)) {
			return Resp::error('IP 不合法');
		}

		/** @var IpContract $Ip */
		$Ip = app(IpContract::class);
		return Resp::success('成功', [
			'area' => $Ip->area($ip),
		]);
	}
}