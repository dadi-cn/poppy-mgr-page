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
    $route->get('/apidoc/how', 'ApiDocController@how');
});