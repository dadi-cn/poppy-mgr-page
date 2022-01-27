<?php

use Illuminate\Routing\Router;

Route::group([
    'namespace' => 'Poppy\MgrApp\Http\Request\Api\Backend',
], function (Router $router) {
    // 用户信息
    $router->any('user/info', 'UserController@info');
});