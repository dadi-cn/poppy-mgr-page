<?php namespace Poppy\Core\Module\Repositories;

use Illuminate\Support\Collection;
use Poppy\Core\Classes\Core;
use Poppy\Core\Classes\PyCoreDef;
use Poppy\Framework\Support\Abstracts\Repository;

/**
 * Setting Modules
 */
class ModulesSetting extends Repository
{

    /**
     * Initialize.
     * @param Collection $data 集合
     */
    public function initialize(Collection $data)
    {
        $this->items = sys_cache('py-core')->remember(
            PyCoreDef::ckModule('setting'),
            PyCoreDef::MIN_HALF_DAY,
            function () use ($data) {
                $collection = collect();
                $data->each(function ($items, $slug) use ($collection) {
                    $items = collect($items);
                    $items->count() && $items->each(function ($items, $entry) use ($collection, $slug) {
                        $collection->put($entry, $items);
                    });
                });

                return $collection->all();
            }
        );
    }
}
