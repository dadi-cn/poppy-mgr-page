<?php namespace Poppy\Demo\Http;

/**
 * Copyright (C) Update For IDE
 */

use Poppy\System\Classes\Abstracts\SysRouteServiceProvider;
use Route;

class RouteServiceProvider extends SysRouteServiceProvider
{
    /**
     * Define the routes for the module.
     * @return void
     */
    public function map(): void
    {
        Route::group([
            'prefix'     => 'demo',
            'middleware' => 'web',
        ], function () {
            require_once __DIR__ . '/Routes/web.php';
        });
    }
}