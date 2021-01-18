<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['cross'],
	'namespace'  => 'Suggest\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
	$route->get('/', 'MyController@index');
});