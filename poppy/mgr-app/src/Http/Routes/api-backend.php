<?php

use Illuminate\Routing\Router;

Route::group([
    'namespace' => 'Poppy\MgrApp\Http\Request\Api\Backend',
], function (Router $router) {
    // 用户信息
    $router->any('user/info', 'UserController@info');
    $router->any('user/password', 'UserController@password')
        ->name('py-mgr-app:api-backend.user.password');
    $router->any('home/setting/{key}', 'HomeController@setting')
        ->name('py-mgr-app:api-backend.home.setting');
    $router->any('home/upload', 'HomeController@upload')
        ->name('py-mgr-app:api-backend.home.upload');
    $router->any('home/clear-cache', 'HomeController@clearCache')
        ->name('py-mgr-app:api-backend.home.clear_cache');
});