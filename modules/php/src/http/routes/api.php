<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
Route::group([
	'middleware' => ['cross'],
	'namespace'  => 'Php\Http\Request\Api',
], function (Illuminate\Routing\Router $route) {

});