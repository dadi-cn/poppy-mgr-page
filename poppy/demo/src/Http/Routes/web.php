<?php

use Illuminate\Routing\Router;

Route::group([
    'namespace' => 'Poppy\Demo\Http\Request\Web',
], function (Router $router) {
    // 所有 Demo 界面
    $router->any('demo', 'DemoController@index')
        ->name('py-demo:web.demo.index');

    $router->any('content', 'ContentController@index')
        ->name('py-demo:web.content.index');
    $router->any('content/form', 'ContentController@form')
        ->name('py-demo:web.content.form');
    $router->any('form/{type}', 'FormController@index')
        ->name('py-demo:web.form.index');
    $router->any('table', 'TableController@index')
        ->name('py-demo:web.table.index');
    $router->any('table/grid/data', 'TableController@gridData')
        ->name('py-demo:web.table.grid_data');
    $router->any('table/grid/demo', 'TableController@demo')
        ->name('py-demo:web.table.grid_data');

    // EnvHelper
    $router->any('helper/env', 'HelperController@env')
        ->name('py-demo:web.helper.env');
    $router->any('helper/img_str', 'HelperController@imgStr')
        ->name('py-demo:web.helper.img_str');
    $router->any('helper/img_bmp', 'HelperController@imgBmp')
        ->name('py-demo:web.helper.img_bmp');
    $router->any('helper/image', 'HelperController@image')
        ->name('py-demo:web.helper.image');
    $router->any('helper/tree', 'HelperController@tree')
        ->name('py-demo:web.helper.tree');
    // env-helper
    $router->any('env/{type}', 'EnvHelperController@index')
        ->name('py-demo:web.env.index');


    /* Layout
     * ---------------------------------------- */
    $router->any('layout/fe', 'JsController@fe')
        ->name('py-demo:web.js.fe');
    $router->any('l/{page?}', 'JsController@index')
        ->name('py-demo:web.js.index');
    $router->any('mail/{slug}/{page?}', 'JsController@mail')
        ->name('py-demo:web.js.mail');
});
