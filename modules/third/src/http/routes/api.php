<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
Route::group([
    'middleware' => ['cross'],
    'namespace'  => 'Third\Http\Request\Api',
], function (Illuminate\Routing\Router $route) {
    $route->get('/', 'DemoController@index');
});