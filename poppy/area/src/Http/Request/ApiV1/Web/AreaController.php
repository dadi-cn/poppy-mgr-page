<?php namespace Poppy\Area\Http\Request\ApiV1\Web;

use Poppy\Area\Models\AreaContent;
use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Helper\UtilHelper;
use Poppy\System\Http\Request\ApiV1\Web\WebApiController;

/**
 * 地区管理控制器
 */
class AreaController extends WebApiController
{

    /**
     * @api                   {get} api_v1/area/code [area]地区代码
     * @apiDescription        version 2.3
     * @apiVersion            1.0.0
     * @apiName               AreaCode
     * @apiGroup              Module
     * @apiSuccess {int}      id                  ID
     * @apiSuccess {string}   title               地区名称
     * @apiSuccess {object[]} cities              所属城市子集
     * @apiSuccess {int}      cities.id           城市ID
     * @apiSuccess {string}   cities.title        城市名称
     * @apiSuccess {object[]} cities.areas        地区信息
     * @apiSuccess {int}      cities.areas.id     地区ID
     * @apiSuccess {string}   cities.areas.title  地区名称
     * @apiSuccessExample     城市数据
     * [
     *     {
     *         "id": 1,
     *         "title": "北京市",
     *         "cities": [
     *             {
     *                 "id": 3,
     *                 "title": "北京市",
     *                 "areas": [
     *                     {
     *                         "id": 4,
     *                         "title": "东城区"
     *                     },
     *                     ...
     *                     {
     *                         "id": 14,
     *                         "title": "大兴区"
     *                     }
     *                 ]
     *             }
     *         ]
     *     },
     *     ...
     * ]
     */
    public function code()
    {
        $items = AreaContent::get()->toArray();
        $array = UtilHelper::genTree($items, 'id', 'parent_id', 'areas');

        $return = [];
        foreach ($array as $province_key => $province_value) {
            $new_province_value = [
                'id'    => $province_value['id'],
                'title' => $province_value['title'],
            ];
            if (!isset($province_value['areas'])) {
                continue;
            }
            foreach ($province_value['areas'] as $city_key => $city_value) {
                $new_city_value = [
                    'id'    => $city_value['id'],
                    'title' => $city_value['title'],
                ];
                if (!isset($city_value['areas'])) {
                    continue;
                }
                foreach ($city_value['areas'] as $area_key => $area_value) {
                    $new_area_value            = [
                        'id'    => $area_value['id'],
                        'title' => $area_value['title'],
                    ];
                    $new_city_value['areas'][] = $new_area_value;
                }

                $new_province_value['cities'][] = $new_city_value;
            }
            $return[$province_key] = $new_province_value;
        }

        return Resp::web(Resp::SUCCESS, '获取数据成功', $return);
    }
}