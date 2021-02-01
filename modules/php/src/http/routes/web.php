<?php
/*
|--------------------------------------------------------------------------
| Php Web Controller
|--------------------------------------------------------------------------
|
*/
Route::group([
	'middleware' => ['cross'],
	'namespace'  => 'Php\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
	$route->get('output_control/ob_flush', 'OutputControlController@obFlush')
		->name('php:output_control.ob_flush');
	$route->get('emoji/match', 'EmojiControlController@match')
		->name('php:emoji.match');
});

Route::group([
    'middleware' => ['php.test'],
    'namespace'  => 'Php\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
    $route->get('middleware/test', 'MiddlewareTestController@index')
        ->name('php:middleware.test');
});
Route::group([
    'namespace'  => 'Php\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
    $route->get('middleware/test-call', 'MiddlewareTestController@call')
        ->name('php:middleware.test_call');
});