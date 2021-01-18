<?php

use Illuminate\Routing\Router;

\Route::group([
	'namespace'  => 'Essay\Request\Backend',
	'middleware' => ['auth:backend', 'disabled_pam', 'be_append_data', 'permission'],
], function (Router $router) {
	$router->any('essay', 'EssayController@index')
		->name('essay:backend.content.index');
	$router->any('essay/establish/{id?}', 'EssayController@establish')
		->name('essay:backend.content.establish');
	$router->any('essay/delete/{id?}', 'EssayController@delete')
		->name('essay:backend.content.delete');
});