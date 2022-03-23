<?php

use Illuminate\Routing\Router;


Route::group([
    'namespace' => 'Poppy\MgrPage\Http\Request\Develop',
], function (Router $router) {
    /* Pam
     * ---------------------------------------- */
    $router->any('logout', 'PamController@logout')
        ->name('py-mgr-page:develop.pam.logout');

    /* Env
     * ---------------------------------------- */
    $router->get('env/phpinfo', 'EnvController@phpinfo')
        ->name('py-mgr-page:develop.env.phpinfo');
    $router->get('env/db', 'EnvController@db')
        ->name('py-mgr-page:develop.env.db');

    /* Log
     * ---------------------------------------- */
    $router->any('log', 'LogController@index')
        ->name('py-mgr-page:develop.log.index');

    /* ApiDoc
     * ---------------------------------------- */
    $router->any('api/field/{type}/{field}', 'ApiController@field')
        ->name('py-mgr-page:develop.api.field');
    $router->any('api/login', 'ApiController@login')
        ->name('py-mgr-page:develop.api.login');
    $router->any('api/{type?}', 'ApiController@index')
        ->name('py-mgr-page:develop.api.index');


    // progress
    $router->any('progress', 'ProgressController@index')
        ->name('py-mgr-page:develop.progress.index');
    $router->any('progress/lists', 'ProgressController@lists')
        ->name('py-mgr-page:develop.progress.lists');
});
