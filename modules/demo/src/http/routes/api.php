<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
Route::group([
    'middleware' => ['cross'],
    'namespace'  => 'Demo\Http\Request\Api\Web',
], function (Illuminate\Routing\Router $route) {
    $route->get('apidoc/how', 'ApiDocController@how');
    $route->get('resp/success', 'RespController@success');
    $route->get('resp/error', 'RespController@error');
    $route->get('resp/401', 'RespController@unAuth');
    $route->get('resp/header', 'RespController@header');
    // form 数据
    $route->any('form/{field}', 'MgrAppController@form');
    $route->any('grid/{grid}', 'MgrAppController@grid');
});

Route::group([
    'middleware' => ['api-sso'],
    'namespace'  => 'Demo\Http\Request\Api\Web',
], function (Illuminate\Routing\Router $route) {
    $route->post('sso/access', 'SsoController@access');
});