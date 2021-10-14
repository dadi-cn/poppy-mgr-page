<?php namespace Op\Http\Request\ApiV1\Web;

use Op\Action\QqAction;
use Poppy\Framework\Classes\Resp;
use Poppy\System\Http\Request\ApiV1\Web\WebApiController;

/**
 * 工具
 */
class QqController extends WebApiController
{

    /**
     * @api                 {get} api_v1/op/qq/auth 保存授权Url
     * @apiDescripiton      授权Url
     * @apiVersion          1.0.0
     * @apiName             QqAuth
     * @apiGroup            Op
     * @apiParam {String}   url  需要保存的Url的全部信息
     */
    public function auth()
    {
        $Act = new QqAction();
        $url = input('url');
        if ($Act->saveByUrl($url)) {
            return Resp::success('已存储');
        }
        return Resp::error($Act->getError());
    }
}