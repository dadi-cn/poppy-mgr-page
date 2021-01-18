<?php

use Illuminate\Routing\Router;

Route::group([
    'namespace' => 'Poppy\MgrPage\Http\Request\Develop',
], function (Router $router) {
    $router->any('api_doc/json/{type?}', 'ApiDocController@json')
        ->name('py-mgr-page:develop.doc.json');
});

Route::group([
    'middleware' => 'develop-auth',
    'namespace'  => 'Poppy\MgrPage\Http\Request\Develop',
], function (Router $router) {
    /* Pam
     * ---------------------------------------- */
    $router->any('logout', 'PamController@logout')
        ->name('py-mgr-page:develop.pam.logout');

    /* Control
     * ---------------------------------------- */
    $router->get('api', 'CpController@api')
        ->name('py-mgr-page:develop.cp.api');
    $router->any('set_token', 'CpController@setToken')
        ->name('py-mgr-page:develop.cp.set_token');
    $router->any('api_login', 'CpController@apiLogin')
        ->name('py-mgr-page:develop.cp.api_login');
    $router->get('doc/{type?}', 'CpController@doc')
        ->name('py-mgr-page:develop.cp.doc');

    /* Env
     * ---------------------------------------- */
    $router->get('env/phpinfo', 'EnvController@phpinfo')
        ->name('py-mgr-page:develop.env.phpinfo');
    $router->get('env/db', 'EnvController@db')
        ->name('py-mgr-page:develop.env.db');
    $router->get('env/model', 'EnvController@model')
        ->name('py-mgr-page:develop.env.model');

    /* Log
     * ---------------------------------------- */
    $router->any('log', 'LogController@index')
        ->name('py-mgr-page:develop.log.index');

    /* ApiDoc
     * ---------------------------------------- */
    $router->any('api_doc/field/{type}/{field}', 'ApiDocController@field')
        ->name('py-mgr-page:develop.doc.field');
    $router->any('api_doc/{type?}', 'ApiDocController@auto')
        ->name('py-mgr-page:develop.doc.index');


    // progress
    $router->any('progress', 'ProgressController@index')
        ->name('py-mgr-page:develop.progress.index');
    $router->any('progress/lists', 'ProgressController@lists')
        ->name('py-mgr-page:develop.progress.lists');
});
