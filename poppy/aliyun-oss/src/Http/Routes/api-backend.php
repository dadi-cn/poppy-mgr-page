<?php

use Illuminate\Routing\Router;

Route::group([
    'namespace' => 'Poppy\AliyunOss\Http\Request\Api\Backend',
], function (Router $router) {
    $router->any('upload/store', 'UploadController@store')
        ->name('py-aliyun-oss:api-backend.home.store');
});