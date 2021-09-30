<?php
/*
|--------------------------------------------------------------------------
| Web Api 路由
|--------------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Op\Http\Request\ApiV1\Web',
], function (Illuminate\Routing\Router $route) {
    $route->any('aliyun/cdn', 'AliyunController@cdn');
    $route->any('aliyun/dcdn', 'AliyunController@dcdn');
    $route->any('mail/send', 'MailController@send');
    $route->any('ip/query', 'IpController@query');
    $route->any('tool/apidoc', 'ToolController@apidoc');
});
