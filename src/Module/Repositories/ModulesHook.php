<?php namespace Poppy\Core\Module\Repositories;

use Illuminate\Support\Collection;
use Poppy\Core\Classes\Core;
use Poppy\Core\Classes\Traits\CoreTrait;
use Poppy\Framework\Exceptions\ApplicationException;
use Poppy\Framework\Support\Abstracts\Repository;

/**
 * 定义的钩子
 */
class ModulesHook extends Repository
{
    use CoreTrait;


    const CACHE_NAME = 'module.repo.hooks';

    /**
     * Initialize.
     * @param Collection $data 集合
     */
    public function initialize(Collection $data)
    {
        $this->items = sys_cache('py-core')->remember(
            self::CACHE_NAME,
            Core::MIN_HALF_DAY,
            function () use ($data) {
                $collection = collect();
                $data->each(function ($items) use ($collection) {
                    $items = collect($items);
                    $items->each(function ($item) use ($collection) {
                        $service = $this->coreModule()->services()->get($item['name']);
                        if ($service['type'] === 'array') {
                            $data = (array) $collection->get($item['name']);
                            if (!isset($item['hooks'])) {
                                throw new ApplicationException("Hook `{$item['name']}` did not has property `hooks`");
                            }
                            if (!is_array($item['hooks'])) {
                                throw new ApplicationException("Hook `{$item['name']}` 的 `hooks` 必须是数组");
                            }
                            $collection->put($item['name'], array_merge($data, $item['hooks']));
                        }
                        if ($service['type'] === 'form') {
                            $collection->put($item['name'], $item['builder']);
                        }
                        if ($service['type'] === 'html') {
                            $data = (array) $collection->get($item['name']);
                            $collection->put($item['name'], array_merge($data, $item['hooks']));
                        }
                    });
                });

                return $collection->all();
            }
        );
    }
}
