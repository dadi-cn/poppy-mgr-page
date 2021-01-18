<?php

/*/*
|--------------------------------------------------------------------------
| Util
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['cross'],
	'namespace'  => 'Site\Http\Request\ApiV1\Web',
], function (Illuminate\Routing\Router $route) {
	$route->post('xmlrpc', 'XmlRpcController@on');
});
