<?php
/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
|
*/
Route::group([
	'middleware' => ['cross', 'web', 'auth:web'],
	'namespace'  => 'Essay\Http\Request\Web',
], function (Illuminate\Routing\Router $route) {
	$route->any('book/my', 'BookController@my')
		->name('essay:book.my');
	$route->any('book/establish/{id?}', 'BookController@establish')
		->name('essay:book.establish');
	$route->any('book/{id?}', 'BookController@show')
		->name('essay:book.show');

	$route->any('article/create', 'ArticleController@create')
		->name('essay:article.create');
	$route->any('article/popup/{id?}', 'ArticleController@popup')
		->name('essay:article.popup');
	$route->any('article/establish/{id}', 'ArticleController@establish')
		->name('essay:article.establish');
	$route->any('article/{id}', 'ArticleController@show')
		->name('essay:article.show');
	$route->any('article/destroy/{id}', 'ArticleController@destroy')
		->name('essay:article.destroy');

	$route->any('article/access/{id}', 'ArticleController@access')
		->name('web:prd.access');
	$route->any('article/address/{id}', 'ArticleController@address')
		->name('web:prd.address');
	$route->any('article/status/{id}/{type}', 'ArticleController@status')
		->name('web:prd.status');
	Route::any('article/my_book_item/{id?}', 'ArticleController@myBookItem')
		->name('web:prd.my_book_item');
});