<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
\Route::group([
	'middleware' => ['web', 'auth:web'],
	'namespace'  => 'Url\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
	$route->get('collection', 'CollectionController@index')
		->name('url:web.collection.index');
	$route->any('collection/establish/{id?}', 'CollectionController@establish')
		->name('url:web.collection.establish');
	$route->any('collection/delete/{id}', 'CollectionController@delete')
		->name('url:web.collection.delete');
	$route->any('collection/fetch_title', 'CollectionController@fetchTitle')
		->name('url:web.collection.fetch_title');
});