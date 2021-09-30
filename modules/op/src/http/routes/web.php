<?php
/*
|--------------------------------------------------------------------------
| Web Api 路由
|--------------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Op\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
    $route->any('img/{spec}/{text?}', 'ImagePhController@generate');
});