<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['cross'],
	'namespace'  => 'Fe\Request\Api',
], function (Illuminate\Routing\Router $route) {
	$route->get('/', 'DemoController@index');
});