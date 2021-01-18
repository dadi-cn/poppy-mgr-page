<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
Route::group([
    'middleware' => ['cross'],
    'namespace'  => 'Demo\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
    $route->get('/', 'DemoController@index');
});