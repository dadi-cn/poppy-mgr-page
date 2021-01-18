<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['cross'],
	'namespace'  => 'Url\Request\Api',
], function (Illuminate\Routing\Router $route) {
	$route->get('/', 'DemoController@index');
});