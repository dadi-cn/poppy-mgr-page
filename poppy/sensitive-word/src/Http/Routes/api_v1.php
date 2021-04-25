<?php
Route::group([
    'namespace' => 'Poppy\SensitiveWord\Http\Request\ApiV1\Web',
], function (Illuminate\Routing\Router $route) {
    $route->any('area/code', 'AreaController@code');
    $route->any('area/country', 'AreaController@country');
});