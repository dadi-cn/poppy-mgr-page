<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['cross'],
	'namespace'  => 'Essay\Http\Request\Api',
], function (Illuminate\Routing\Router $route) {
	$route->any('xmlrpc', 'XmlRpcController@on');
});