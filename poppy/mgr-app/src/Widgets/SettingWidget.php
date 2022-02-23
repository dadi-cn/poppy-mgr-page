<?php

namespace Poppy\MgrApp\Widgets;

use Poppy\Framework\Classes\Resp;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\MgrApp\Http\Forms\MgrAppSettings\SettingBase;
use Throwable;

/**
 * 设置
 */
class SettingWidget
{

    public function resp(string $path)
    {
        try {
            $hooks    = sys_hook('poppy.mgr-app.settings');
            $strForms = $hooks[$path]['forms'] ?? [];
            $forms    = collect();
            collect($strForms)->map(function ($form_class) use ($forms) {
                $form = app($form_class);
                if (!($form instanceof SettingBase)) {
                    throw new ApplicationException('设置表单需要继承 `SettingBase` Class');
                }
                $forms->put($form->getGroup(), $form);
            });


            if (is_post()) {
                $group = input('_group');
                if (!$group) {
                    return Resp::error('请传递分组标识');
                }
                /** @var SettingBase $cur */
                $cur = $forms->offsetGet($group);
                return $cur->resp();
            }

            // 当前的所有表单
            $fms = collect();
            collect($forms)->each(function (SettingBase $form) use ($fms) {
                $fms->put($form->getGroup(), $form->resp(true));
            });

            // 所有的列表分组
            $groups = collect();
            collect($hooks)->map(function ($item, $key) use ($groups) {
                $groups->push([
                    'path'  => route_url('py-mgr-app:api-backend.home.setting', [$key], [], false),
                    'title' => $item['title']
                ]);
            });

            return Resp::success('获取成功', [
                'type'   => 'setting',
                'path'   => route_url('py-mgr-app:api-backend.home.setting', [$path], [], false),
                'groups' => $groups->toArray(),
                'forms'  => $fms,
            ]);
        } catch (Throwable $e) {
            return Resp::error($e->getMessage());
        }
    }
}
