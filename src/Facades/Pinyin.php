<?php namespace Poppy\Extension\Pinyin\Facades;

/*
 * This file is part of the overtrue/laravel-pinyin.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Illuminate\Support\Facades\Facade;

class Pinyin extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'poppy.ext.pinyin';
    }
}
