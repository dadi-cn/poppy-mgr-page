<?php
/*
|--------------------------------------------------------------------------
| Web Api 路由
|--------------------------------------------------------------------------
*/
\Route::group([
	'middleware' => ['op.maintain_token'],
	'namespace'  => 'Op\Http\Request\ApiV1\Maintain',
], function (Illuminate\Routing\Router $route) {
	$route->any('aliyun/cdn', 'AliyunController@cdn');
	$route->any('aliyun/dcdn', 'AliyunController@dcdn');
	$route->any('mail/send', 'MailController@send');
	$route->any('ip/query', 'IpController@query');
});