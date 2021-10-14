<?php
/*
|--------------------------------------------------------------------------
| Web Api 路由
|--------------------------------------------------------------------------
*/

Route::group([
    'namespace' => 'Op\Http\Request\ApiV1\Web',
], function (Illuminate\Routing\Router $route) {
    $route->any('ip/query', 'IpController@query');
    $route->any('tool/apidoc', 'ToolController@apidoc');

    $route->any('qq/auth', 'QqController@auth');
});

Route::group([
    'middleware' => ['op.maintain'],
    'namespace'  => 'Op\Http\Request\ApiV1\Maintain',
], function (Illuminate\Routing\Router $route) {
    $route->any('mail/send', 'MailController@send');
    $route->any('mail/group', 'MailController@group');
});
