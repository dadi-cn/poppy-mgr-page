<?php

use Illuminate\Routing\Router;

Route::group([
    'namespace' => 'Poppy\SensitiveWord\Http\Request\Backend',
], function (Router $router) {
    $router->any('/', 'ContentController@index')
        ->name('py-sensitive-word:backend.content.index');
    $router->any('establish/{id?}', 'ContentController@establish')
        ->name('py-sensitive-word:backend.content.establish');
    $router->any('delete/{id?}', 'ContentController@delete')
        ->name('py-sensitive-word:backend.content.delete');
});