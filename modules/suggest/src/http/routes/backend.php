<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['auth:backend', 'disabled_pam', 'be_append_data', 'permission'],
	'namespace'  => 'Suggest\Http\Request\Backend',
], function (Illuminate\Routing\Router $route) {
	$route->get('/', 'DemoController@index');
});