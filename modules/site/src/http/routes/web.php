<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['cross', 'web'],
	'namespace'  => 'Site\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
	// home
	$route->get('/', 'HomeController@index')
		->name('web:home.index');
	$route->get('home/vue', 'HomeController@vue')
		->name('site:web.home.vue');


	$route->get('test', 'TestController@index');

	$route->get('tag/search', 'TagController@search')
		->name('site:web.tag.search');

	/* User
	 * ---------------------------------------- */
	$route->any('user/login', 'UserController@login')
		->name('site:user.login');
	$route->any('user/register/{type?}', 'UserController@register')
		->name('site:user.register');
	$route->any('user/logout', 'UserController@logout')
		->name('site:user.logout');

	/* Tools
	 * ---------------------------------------- */
	$route->get('tool', 'ToolController@index')
		->name('site:tool.index');
	$route->get('tool/format/{type?}', 'ToolController@format')
		->name('site:tool.format');
	$route->any('tool/man_to_md', 'ToolController@manToMd')
		->name('site:tool.man_to_md');
	$route->any('tool/html_entity', 'ToolController@htmlEntity')
		->name('site:tool.html_entity');
	$route->any('tool/ssl_key', 'ToolController@sslKey')
		->name('site:tool.ssl_key');
	$route->any('tool/md_extend', 'ToolController@mdExtend')
		->name('site:tool.md_extend');
});