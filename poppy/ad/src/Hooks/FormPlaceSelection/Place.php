<?php

namespace Poppy\Ad\Hooks\FormPlaceSelection;

use Illuminate\Support\HtmlString;
use Poppy\Ad\Models\AdPlace;
use Poppy\Core\Services\Contracts\ServiceForm;

/**
 * 选择广告位
 */
class Place implements ServiceForm
{
    /**
     * @param array $params 参数
     * @return HtmlString|mixed
     */
    public function builder(array $params = [])
    {
        $name    = $params['name'];
        $value   = $params['value'] ?? null;
        $options = $params['options'] ?? [];

        $options += [
            'class'       => 'layui-input',
            'placeholder' => '请选择广告位',
        ];
        $places  = AdPlace::pluck('title', 'id');

        return \Form::select($name, $places, $value, $options);
    }
}