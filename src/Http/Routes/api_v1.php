<?php
Route::group([
    'middleware' => ['api-sign'],
    'namespace'  => 'Area\Http\Request\ApiV1\Web',
], function (Illuminate\Routing\Router $route) {
    $route->any('code', 'AreaController@code');
});