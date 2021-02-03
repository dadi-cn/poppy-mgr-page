<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
Route::group([
    'middleware' => ['cross'],
    'namespace'  => 'Third\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
    $route->get('/', 'DemoController@index');
});