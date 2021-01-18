<?php namespace Poppy\Framework\Events;

use Illuminate\Support\Collection;
use Poppy\Framework\Application\Event;

/**
 * 集成完成
 */
class PoppyMigrated extends Event
{
    /**
     * @var Collection 模块
     */
    public $module;

    /**
     * @var array|mixed
     */
    private $option;

    /**
     * @param Collection $module
     * @param array      $option
     */
    public function __construct(Collection $module, $option = [])
    {
        $this->module = $module;
        $this->option = $option;
    }
}