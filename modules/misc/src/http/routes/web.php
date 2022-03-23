<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
    'middleware' => ['cross', 'web'],
    'namespace'  => 'Misc\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
    // home
    $route->get('/', 'HomeController@index')
        ->name('misc:web.home.index');
    $route->get('home/vue', 'HomeController@vue')
        ->name('misc:web.home.vue');

    $route->get('tag/search', 'TagController@search')
        ->name('misc:web.tag.search');

    /* User
     * ---------------------------------------- */
    $route->any('user/login', 'UserController@login')
        ->name('misc:user.login');
    $route->any('user/register/{type?}', 'UserController@register')
        ->name('misc:user.register');
    $route->any('user/logout', 'UserController@logout')
        ->name('misc:user.logout');

    /* Tools
     * ---------------------------------------- */
    $route->get('tool', 'ToolController@index')
        ->name('misc:tool.index');
    $route->get('tool/format/{type?}', 'ToolController@format')
        ->name('misc:tool.format');
    $route->any('tool/man_to_md', 'ToolController@manToMd')
        ->name('misc:tool.man_to_md');
    $route->any('tool/html_entity', 'ToolController@htmlEntity')
        ->name('misc:tool.html_entity');
    $route->any('tool/ssl_key', 'ToolController@sslKey')
        ->name('misc:tool.ssl_key');
    $route->any('tool/md_extend', 'ToolController@mdExtend')
        ->name('misc:tool.md_extend');
});