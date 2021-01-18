<?php

/*
|--------------------------------------------------------------------------
| Util
|--------------------------------------------------------------------------
|
*/
Route::group([
	'namespace' => 'Slt\Request\Web',
], function (Illuminate\Routing\Router $route) {

	Route::get('fe/md', 'FeController@markdown')
		->name('slt:fe.md');

	// user
	$route->any('user/forgot_password', 'UserController@getForgotPassword')
		->name('slt:user.forgot_password');
	$route->group([
		'middleware' => 'auth:web',
	], function (Illuminate\Routing\Router $route) {
		$route->any('user/profile', 'UserController@profile')
			->name('slt:user.profile');
		$route->any('user/nickname', 'UserController@nickname')
			->name('slt:user.nickname');
		$route->any('user/avatar', 'UserController@avatar')
			->name('slt:user.avatar');
	});
});