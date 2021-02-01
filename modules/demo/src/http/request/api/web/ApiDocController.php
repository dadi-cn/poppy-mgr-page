<?php namespace Demo\Http\Request\Api\Web;

use Poppy\Framework\Application\ApiController;
use Poppy\Framework\Classes\Resp;

class ApiDocController extends ApiController
{
    /**
     * @api               {get} api/demo/apidoc/how ApiDoc编写示例
     * @apiDescription    怎样写Apidoc
     * @apiVersion        1.0.0
     * @apiName           DemoApidocHow
     * @apiGroup          Demo
     * @apiParam {bool}           boolean 布尔值类型
     * @apiParam {int}            number 数值
     * @apiParam {int{100-999}}   number_range 数值范围
     * @apiParam {string}         string 字串
     * @apiParam {string{..5}}    string_mx 字串最大5
     * @apiParam {string{2..5}}   string_between 字串间隔
     * @apiParam {int{2..5}}      number_between 数值间隔
     * @apiParam {int=1,2,3,99}   number_select 数值间隔
     * @apiParam {string=banana,apple,ball}  string_select 字串枚举
     */
    public function how()
    {
        return Resp::success('返回输入值', input());
    }
}