<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
Route::group([
    'middleware' => ['cross'],
    'namespace'  => 'Demo\Http\Request\Api',
], function (Illuminate\Routing\Router $route) {
    $route->get('/', 'DemoController@index');
});