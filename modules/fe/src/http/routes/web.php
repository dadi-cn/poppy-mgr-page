<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['web'],
	'namespace'  => 'Fe\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {

});