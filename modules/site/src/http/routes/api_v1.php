<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['cross'],
	'namespace'  => 'Site\Http\Request\ApiV1\Web',
], function (Illuminate\Routing\Router $route) {
	$route->get('resp/success', 'RespController@success');
	$route->get('resp/error', 'RespController@error');
});