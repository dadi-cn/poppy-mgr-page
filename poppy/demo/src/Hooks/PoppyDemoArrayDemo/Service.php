<?php namespace Poppy\Demo\Hooks\PoppyDemoArrayDemo;

use Poppy\Core\Services\Contracts\ServiceArray;

/**
 * 选择广告位
 */
class Service implements ServiceArray
{

    public function key()
    {
        return 'poppy-core-array-service';
    }


    public function data()
    {
        return [];
    }
}